<template><div class="ui-address">
    <l-map :zoom="16" :center="[(props.value.lat||0), (props.value.lng||0)]" style="height:200px;">
        <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
        <l-marker :lat-lng="[(props.value.lat||0), (props.value.lng||0)]" :draggable="true" @moveend="getAddressByLatLng($event)"></l-marker>
    </l-map>

    <div class="row">
        <div class="col-12 pb-3">
            <small class="d-block bg-dark text-white p-2">
                <span v-if="props.value.route">{{ props.value.route }}, </span>
                <span v-if="props.value.number">Nº {{ props.value.number }}, </span>
                <span v-if="props.value.zipcode">CEP {{ props.value.zipcode }}, </span>
                <span v-if="props.value.district">{{ props.value.district }}</span>
                <span v-if="props.value.city">- {{ props.value.city }}</span>
                <span v-if="props.value.state">{{ props.value.state }}</span>
            </small>
        </div>

        <div class="col-12 pb-1">
            <div class="input-group" style="position:relative; max-width:500px;">
                <input type="text" class="form-control" v-model="search.params.q" @keyup="autocomplete()" placeholder="Buscar endereço">
                <div class="input-group-append input-group-text">
                    <i class="fa fa-fw fa-search"></i>
                </div>

                <div class="shadow-sm bg-white" style="position:absolute; top:100%; left:0px; width:100%; max-height:50vh; overflow:auto; z-index:2;">
                    <a href="javascript:;" class="p-2 d-block" v-for="r in search.results" :key="r.place_id" @click="selectPlace(r)">
                        {{ r.address.road }}, {{ r.address.suburb }}, {{ r.address.city }}, {{ r.address.state }}/{{ r.address.country_code.toUpperCase() }}
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 pb-1">
            <input type="text" class="form-control" v-model="props.value.name" placeholder="Descrição Ex.: Endereço principal, secundário, etc.">
        </div>
        <div class="col-8 pb-1"><input type="text" class="form-control" v-model="props.value.complement" placeholder="Complemento"></div>
        <div class="col-4 pb-2"><input type="text" class="form-control" v-model="props.value.number" placeholder="Número"></div>

        <div class="col-12 text-right" v-if="showBtnSave">
            <button type="button" class="btn btn-primary" @click="save()">
                <i class="fa fa-fw fa-save"></i> Salvar
            </button>
        </div>
    </div>
</div></template>

<script>export default {
    props: {
        value: {default: () => ({})},
        reference: {default:''},
        refId: {default:''},
        showBtnSave: {default:true},
    },

    methods: {
        save() {
            this.$axios.post('/api/address/save', this.props.value).then((resp) => {
                this.$emit('saved', resp);
            });
        },

        autocomplete() {
            if (this.autocompleteTimeout) clearTimeout(this.autocompleteTimeout);
            this.autocompleteTimeout = setTimeout(() => {
                this.$axios.get('https://nominatim.openstreetmap.org/search', {params:this.search.params}).then((resp) => {
                    this.search.results = resp.data;
                });
            }, 1000);
        },

        selectPlace(place) {
            this.$set(this.props, 'value', Object.assign(this.props.value, {
                lat: (place.lat? parseFloat(place.lat): 0),
                lng: (place.lon? parseFloat(place.lon): 0),
                route: place.address.road,
                number: '',
                complement: '',
                zipcode: place.address.postcode,
                district: place.address.suburb,
                city: place.address.city,
                state: place.address.state,
                st: '',
                country: place.address.country,
                co: place.address.country_code.toUpperCase(),
            }));
            
            this.$set(this.search.params, 'q', '');
            this.$set(this.search, 'results', []);

            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        getAddressByLatLng(ev) {
            let params = {
                format: 'json',
                lat: ev.target._latlng.lat,
                lon: ev.target._latlng.lng,
                zoom: 18,
                addressdetails: 1,
            };

            this.$axios.get('https://nominatim.openstreetmap.org/reverse', {params:params}).then((resp) => {
                this.selectPlace(resp.data);
            });
        },
    },

    data() {
        let data = {};

        data.props = Object.assign({}, this.$props);
        data.props.value = Object.assign({
            id: '',
            name: '',
            ref: this.reference,
            ref_id: this.refId,
            lat: 0,
            lng: 0,
            route: '',
            number: '',
            complement: '',
            zipcode: '',
            district: '',
            city: '',
            state: '',
            st: '',
            country: '',
            co: '',
        }, data.props.value);

        data.search = {
            params: {
                q: "",
                format: "json",
                addressdetails: 1,
            },
            results: [],
        };

        return data;
    },
};</script>


<style>
.ui-address .leaflet-pane {z-index:1 !important;}
</style>