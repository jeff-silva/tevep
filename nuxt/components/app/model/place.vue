<template>
    <div>
        <v-row>
            <v-col cols="12" md="12">
                <v-text-field
                    :label="placeSave.data.name || label"
                    hide-details
                    v-model="places.params.q"
                    @keyup="places.submit({debounce:1500})"
                    @focus="placesListShow=true"
                    prepend-inner-icon="mdi-magnify"
                    append-icon="mdi-crosshairs"
                    @click:append="getGeolocation"
                    :loading="places.loading"
                ></v-text-field>
                <div style="position:relative; z-index:2;" v-if="placesListShow">
                    <v-card style="background:#fff; position:absolute; width:100%;">
                        <v-list max-height="300px">
                            <v-list-item v-if="places.loading && places.resp.length==0">
                                Carregando resultados
                            </v-list-item>
                            <v-list-item v-if="!places.loading && places.resp.length==0">
                                Nenhum item
                            </v-list-item>
                            <v-list-item v-for="(p, i) in places.resp" :key="i" @click="setPlace(p)">
                                {{ [p.route, p.district, p.city, p.state, p.country].filter(item => item).join(', ') }}
                            </v-list-item>
                        </v-list>
                    </v-card>
                </div>
            </v-col>

            <v-col cols="12" md="8">
                <v-text-field
                    label="Rua"
                    hide-details
                    v-model="placeSave.data.route"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    label="N°"
                    hide-details
                    v-model="placeSave.data.number"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Complemento"
                    hide-details
                    v-model="placeSave.data.complement"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="CEP"
                    hide-details
                    v-model="placeSave.data.zipcode"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Bairro"
                    hide-details
                    v-model="placeSave.data.district"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Cidade"
                    hide-details
                    v-model="placeSave.data.city"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Estado"
                    hide-details
                    v-model="placeSave.data.state"
                    @update:modelValue="placeAutosave()"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-autocomplete
                    label="País"
                    hide-details 
                    v-model="placeSave.data.country_short"
                    @update:modelValue="placeAutosave()"
                    :items="countries"
                ></v-autocomplete>
            </v-col>

            <v-col cols="12">
                <l-map ref="map" :zoom="18" :center="[(placeSave.data.lat||0), (placeSave.data.lng||0)]" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="[(placeSave.data.lat||0), (placeSave.data.lng||0)]" :draggable="true" @dragend="updateLatLng($event)"></l-marker>
                </l-map>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { useGeolocation } from '@vueuse/core';

export default {
    props: {
        modelValue: {default:false, type:[Boolean, Number, String, Object]},
        returnType: {default:'id'}, // id, object
        label: {default:''},
        autoSave: {default:true},
    },

    watch: {
        '$props.modelValue': {async handler() {
            this.placeFind();
        }},
    },

    methods: {
        emitValue() {
            if (this.returnType=='id') {
                this.$emit('update:modelValue', this.placeSave.data.id);
            }
            else if (this.returnType=='object') {
                this.$emit('update:modelValue', {...this.placeSave.data});
            }
        },

        async setPlace(place) {
            let id = (typeof this.modelValue=='object')? (this.modelValue.id): this.modelValue;
            
            if (id) {
                this.placeSave.data = {...place, id};
                this.placeSave.submit();
            }
            else {
                this.placeSave.data = place;
            }

            this.placesListShow = false;
            this.emitValue();
        },

        async placeFind() {
            if (this.returnType=='id') {
                if (isNaN(this.modelValue)) return;
                this.placeSave.data = (await this.$axios.get(`/api/places/find/${this.modelValue}`)).data;
            }
            else if (this.returnType=='object') {
                this.placeSave.data = {...(this.modelValue||{})};
            }
            this.mapRecenter();
        },

        placeAutosave() {
            if (this.autoSave) {
                this.placeSave.submit({debounce:3000});
            }
            if (typeof this.modelValue=='object') {
                this.emitValue();
            }
        },

        mapRecenter() {
            setTimeout(() => {
                console.log('mapRecenter');
                if (!this.$refs.map.leafletObject) return;
                if (!this.$refs.map.leafletObject.panTo) return;
                this.$refs.map.leafletObject.panTo([
                    (this.placeSave.data.lat || 0),
                    (this.placeSave.data.lng || 0),
                ]);
            }, 500);
        },

        updateLatLng(ev) {
            const coords = {...ev.target._latlng};

            if (this._updateLatLngTimeout) {
                clearTimeout(this._updateLatLngTimeout);
            }

            this._updateLatLngTimeout = setTimeout(() => {
                this.$axios.get('/api/places/place-search', {params:coords}).then(resp => {
                    if (!resp.data[0]) return;
                    this.setPlace(resp.data[0]);
                });
            }, 500);
        },

        async getGeolocation() {
            const params = {
                lat: this.geo.coords.latitude,
                lng: this.geo.coords.longitude,
            };

            this.$axios.get('/api/places/place-search', { params }).then(resp => {
                if (!resp.data[0]) return;
                this.setPlace(resp.data[0]);
            });
        },
    },

    async mounted() {
        this.placeFind();
    },

    data() {
        return {
            placesListShow: false,
            places: useAxios({
                method: 'get',
                url: '/api/places/place-search',
                params: {q:''},
                resp: [],
            }),
            placeSave: useAxios({
                method: 'post',
                url: '/api/places/save',
                data: {},
            }),
            geo: useGeolocation(),
            countries: [
                {value:"AF", title:"Afeganistão"},
                {value:"ZA", title:"África do Sul"},
                {value:"AL", title:"Albânia"},
            ],
        };
    },
};
</script>