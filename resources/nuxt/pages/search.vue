<template><div>
    <l-map ref="map" v-bind="map" style="width:100vw; height:100vh;"
        @update:bounds="eventMapUpdateBounds($event)"
    >
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="[m.lat, m.lng]" v-for="m in markers" :key="m.id">
            <l-icon v-if="m.category_photo">
                <img :src="m.category_photo" alt="" style="width:35px; height:35px;" class="animate__animated animate__flipInX">
            </l-icon>
            <l-popup class="bg-white p-2 animate__animated animate__flipInX" style="width:170px;">
                <div class="font-weight-bold text-uppercase">{{ m.name }}</div>
                <div class="text-muted">{{ m.description }}</div>
                <img :src="m.category_photo" alt="" style="width:100%;" class="">
            </l-popup>
        </l-marker>
    </l-map>

    <div clsas="shadow-sm" style="position:fixed; bottom:0px; right:0px; z-index:999!important; background:#fff;">
        <!-- <pre v-if="markers[0]">{{ markers[0] }}</pre> -->
        <i class="fa fa-fw fa-spin fa-spinner"></i> Carregando...
    </div>
</div></template>

<script>
let eventMapUpdateBoundsTimeout;
export default {
    data() {
        let data = {};
        data.loading = false;
        data.map = {zoom:16, center:[0, 0]};
        data.productTypes = this.modelDefault('productTypes');
        data.productCategories = this.modelDefault('productCategories');
        data.markers = [];
        return data;
    },

    methods: {
        eventMapUpdateBounds(bounds) {
            this.loading = true;
            if (eventMapUpdateBoundsTimeout) clearTimeout(eventMapUpdateBoundsTimeout);
            eventMapUpdateBoundsTimeout = setTimeout(() => {
                let params = {
                    latMin: bounds._southWest.lat,
                    latMax: bounds._northEast.lat,
                    lngMin: bounds._southWest.lng,
                    lngMax: bounds._northEast.lng,
                };
                this.$axios.get('/api/products/business-search', {params:params}).then((resp) => {
                    this.markers = resp.data;
                    this.loading = false;
                });
            }, 1000);
        },
    },

    mounted() {
        this.$geolocation().then((resp) => {
            this.map.center = [resp.lat, resp.lng];
        });
    },
};</script>

<style>
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