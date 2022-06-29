<template>
    <div>
        <v-row>
            <v-col cols="12" md="12" v-if="!readonly">
                <v-menu :close-on-content-click="false">
                    <template #activator="{ props }">
                        <v-text-field
                            v-bind="props"
                            v-model="places.params.q"
                            :loading="places.loading"
                            hide-details
                            :label="label"
                            prepend-inner-icon="mdi-magnify"
                            append-inner-icon="mdi-crosshairs"
                            @click:append-inner="getGeolocation()"
                            @keyup="places.submit({debounce:1500})"
                        />
                    </template>
                    <div style="position:relative; z-index:-1; margin:10px 0 0 -40px; width:calc(100% + 80px);">
                        <v-list elevation="5">
                            <v-list-item v-if="places.resp.length==0">
                                {{ label }}
                            </v-list-item>
                            <v-list-item
                                v-for="a in places.resp"
                                :key="$key(a)"
                                @click="listItemClick(a)"
                            >
                                {{ [a.route, a.district, a.city, a.state].filter(item => !!item).join(', ') }}
                            </v-list-item>
                        </v-list>
                    </div>
                </v-menu>
            </v-col>

            <v-col cols="12" md="8">
                <v-text-field
                    label="Rua"
                    hide-details
                    v-model="propsPlace.route"
                    :readonly="readonly"
                    :variant="'outlined'"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    label="N°"
                    hide-details
                    v-model="propsPlace.number"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Complemento"
                    hide-details
                    v-model="propsPlace.complement"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="CEP"
                    hide-details
                    v-model="propsPlace.zipcode"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Bairro"
                    hide-details
                    v-model="propsPlace.district"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Cidade"
                    hide-details
                    v-model="propsPlace.city"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Estado"
                    hide-details
                    v-model="propsPlace.state"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-select
                    label="País"
                    hide-details 
                    v-model="propsPlace.country_short"
                    :readonly="readonly"
                    :items="countries"
                ></v-select>
            </v-col>

            <v-col cols="12">
                <l-map ref="map" :zoom="18" :center="[(propsPlace.lat||0), (propsPlace.lng||0)]" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="[(propsPlace.lat||0), (propsPlace.lng||0)]" :draggable="true" @dragend="markerDragend($event)"></l-marker>
                </l-map>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { useGeolocation } from '@vueuse/core';

export default {
    props: {
        modelValue: {type:Number, default:false},
        place: {type:Object, default:()=>({})},
        label: {default:'Pesquisar endereço'},
        autoSave: {default:true},
        readonly: {default:false},
        placeFind: {default:true},
    },

    watch: {
        propsPlace: {deep:true, handler(value) {
            this.$emit('place', value);
        }},
        
        place: {deep:true, handler(value) {
            this.placeUpdate(value);
            this.placeFindLoad(value.id || false);
        }},

        modelValue(value) {
            this.placeFindLoad(value);
        },
    },

    methods: {
        async placeUpdate(place) {
            for(let i in place) this.propsPlace[i] = place[i];
            this.propsPlace.id = this.modelValue || null;
            this.mapCenter();
        },

        async placeFindLoad(id) {
            if (!id || !this.placeFind) return;
            if (this.placeFindTimeout) clearTimeout(this.placeFindTimeout);
            this.placeFindTimeout = setTimeout(async () => {
                let resp = await this.$axios.get(`/api/places/find/${id}`);
                this.placeUpdate(resp.data);
                this.mapCenter();
            }, 200);
        },

        mapCenter() {
            setTimeout(() => {
                if (!this.$refs.map.leafletObject) return;
                if (!this.$refs.map.leafletObject.panTo) return;
                this.$refs.map.leafletObject.panTo([
                    (this.propsPlace.lat || 0),
                    (this.propsPlace.lng || 0),
                ]);
            }, 100);
        },

        markerDragend(ev) {
            const coords = {...ev.target._latlng};

            if (this._updateLatLngTimeout) {
                clearTimeout(this._updateLatLngTimeout);
            }

            this._updateLatLngTimeout = setTimeout(() => {
                this.$axios.get('/api/places/place-search', {params:coords}).then(resp => {
                    if (!resp.data[0]) return;
                    this.placeUpdate(resp.data[0]);
                    this.placeSave.submit();
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
                this.placeUpdate(resp.data[0]);
                this.placeSave.submit();
            });
        },

        listItemClick(place) {
            this.placeUpdate(place);
            this.placeSave.submit().then(resp => {
                this.$emit('update:modelValue', resp.data.id);
            });
        },
    },

    data() {
        return {
            placeFindTimeout: false,
            propsPlace: JSON.parse(JSON.stringify(this.place)),
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
                onSubmit: (placeSave) => {
                    placeSave.data = this.propsPlace;
                },
            }),
            geo: useGeolocation(),
            countries: [
                {value:"AF", title:"Afeganistão"},
                {value:"ZA", title:"África do Sul"},
                {value:"AL", title:"Albânia"},
                {value:"BR", title:"Brasil"},
            ],
        };
    },

    mounted() {
        this.placeFindLoad(this.modelValue);
    },
};
</script>