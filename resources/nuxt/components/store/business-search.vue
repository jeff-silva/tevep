<template><div class="business-search">
    <l-map ref="map" v-bind="props.map" style="position:relative; width:100%; height:100%;"
        @update:bounds="updateBounds($event)"
        @update:center="updateCenter($event)"
    >
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>

        <div v-for="m in props.value" :key="m.id">
            <slot name="map" :marker="m" :setPlace="setPlace">
                <l-marker :lat-lng="[m.lat, m.lng]"></l-marker>
            </slot>
        </div>
    </l-map>
</div></template>


<script>
import Business from '@/models/Business';
let getBusinessTimeout, setPlaceTimeout;

export default {
    props: {
        map: {default:()=>({})},
        search: {default:()=>({})},
        value: {default:()=>([])},
        searchInsideBounds: {default:true},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                value = Object.assign({}, this.props||{});
                this.$set(this, 'props', value);
            }
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
            this.$emit('value', this.props.value);
        },

        getBusiness() {
            if (getBusinessTimeout) clearTimeout(getBusinessTimeout);
            getBusinessTimeout = setTimeout(() => {
                let params = Object.assign({}, this.props.search);

                if (!this.searchInsideBounds) {
                    delete params.lat_min;
                    delete params.lat_max;
                    delete params.lng_min;
                    delete params.lng_max;
                }

                this.$axios.get('/api/business/search', {params:params}).then((resp) => {
                    let items = resp.data.map((item) => { return new Business(item); });
                    this.$set(this.props, 'value', items);
                    this.emit();
                });
            }, 500);
        },
        
        updateBounds(ev) {
            this.props.search.lat_min = ev._southWest.lat;
            this.props.search.lat_max = ev._northEast.lat;
            this.props.search.lng_min = ev._southWest.lng;
            this.props.search.lng_max = ev._northEast.lng;
            this.$emit('update:bounds', ev);

            if (this.searchInsideBounds) {
                this.getBusiness();
            }
        },

        updateCenter(ev) {
            if (ev.lat && ev.lng && ev.lat!=this.props.map.center[0] && ev.lng!=this.props.map.center[1]) {
                this.$set(this.props.map, 'center', [
                    ev.lat,
                    ev.lng,
                ]);
                this.$emit('update:center', ev);
                if (this.searchInsideBounds) {
                    this.getBusiness();
                }
            }
        },

        setPlace(ev, marker) {
            return new Promise((resolve, reject) => {
                if (setPlaceTimeout) clearTimeout(setPlaceTimeout);
                setPlaceTimeout = setTimeout(() => {
                    if (ev.type=='dragend') {
                        this.$axios.get(`https://nominatim.openstreetmap.org/reverse?lat=${ev.target._latlng.lat}&lon=${ev.target._latlng.lng}&format=json&addressdetails=1`).then((resp) => {
                            marker.route = resp.data.address.road||"";
                            marker.zipcode = resp.data.address.postcode||"";
                            marker.district = resp.data.address.road||"";
                            marker.city = resp.data.address.city||"";
                            marker.state = resp.data.address.state||"";
                            marker.st = "";
                            marker.country = resp.data.address.country||"";
                            marker.co = resp.data.address.country_code||"";
                            marker.lat = resp.data.lat||"";
                            marker.lng = resp.data.lon||"";
                            resolve(marker);
                        });
                    }
                }, 500);
            });
        },

        moveToMarker(marker) {
            this.$set(this.props.map, 'center', [
                marker.lat,
                marker.lng,
            ]);
        },
    },

    data() {
        let data = {};
        data.props = Object.assign({}, this.$props);

        data.props.map = Object.assign({
            zoom: 16,
            center: [0, 0],
        }, data.props.map);

        data.props.search = Object.assign({
            q: '',
            user_id: '',
            type: '',
            category: '',
            lat_min: '',
            lat_max: '',
            lng_min: '',
            lng_max: '',
        }, data.props.search);

        return data;
    },

    mounted() {
        this.$geolocation().then((resp) => {
            this.$set(this.props.map, 'center', [resp.lat, resp.lng]);
            this.getBusiness();
        });
    },
};</script>

<style>
.business-search {position:relative;}
.business-search .vue2leaflet-map {z-index:1;}

.leaflet-popup-content-wrapper {
    padding: 0px !important;
    border-radius: 0px !important;
    background: none !important;
    box-shadow: none !important;
    height: auto !important;
}

.leaflet-popup-content {
	margin: 0px !important;
}

.leaflet-popup-close-button {
	color: #fff !important;
	background: #f00 !important;
	padding: 2px 0px !important;
	height: auto !important;
	border-radius: 50%;
	margin: -8px -7px 0px 0px !important;
}
</style>