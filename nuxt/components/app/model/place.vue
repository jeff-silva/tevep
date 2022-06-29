<template>
    <div>
        <v-row>
            <v-col cols="12" md="12" v-if="!readonly">
                <v-menu>
                    <template #activator="{ props }">
                        <v-text-field
                            v-bind="props"
                            v-model="places.params.q"
                            :loading="places.loading"
                            hide-details
                            label="Pesquisar endereço"
                            prepend-inner-icon="mdi-magnify"
                            append-inner-icon="mdi-crosshairs"
                            @click:append-inner="getGeolocation()"
                            @keyup="places.submit({debounce:1500})"
                        />
                    </template>
                    <div style="position:relative; z-index:-1; margin:10px 0 0 -40px; width:calc(100% + 80px);">
                        <v-list elevation="5">
                            <v-list-item v-if="places.resp.length==0">
                                Pesquisar endereço
                            </v-list-item>
                            <v-list-item
                                v-for="a in places.resp"
                                :key="$key(a)"
                                @click="placeUpdate(a)"
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
                    v-model="propsModelValue.route"
                    :readonly="readonly"
                    :variant="'outlined'"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    label="N°"
                    hide-details
                    v-model="propsModelValue.number"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Complemento"
                    hide-details
                    v-model="propsModelValue.complement"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="CEP"
                    hide-details
                    v-model="propsModelValue.zipcode"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Bairro"
                    hide-details
                    v-model="propsModelValue.district"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Cidade"
                    hide-details
                    v-model="propsModelValue.city"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Estado"
                    hide-details
                    v-model="propsModelValue.state"
                    :readonly="readonly"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-select
                    label="País"
                    hide-details 
                    v-model="propsModelValue.country_short"
                    :readonly="readonly"
                    :items="countries"
                ></v-select>
            </v-col>

            <v-col cols="12">
                <l-map ref="map" :zoom="18" :center="[(propsModelValue.lat||0), (propsModelValue.lng||0)]" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="[(propsModelValue.lat||0), (propsModelValue.lng||0)]" :draggable="true" @dragend="updateLatLng($event)"></l-marker>
                </l-map>
            </v-col>
        </v-row>
        <pre>propsModelValue: {{ propsModelValue }}</pre>
        <pre>placeSave: {{ placeSave }}</pre>
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
        readonly: {default:false},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    methods: {
        emitValue() {
            // 
        },

        async placeUpdate(place) {
            let id = (typeof this.modelValue=='object')? (this.modelValue.id): this.modelValue;
            for(let i in place) this.propsModelValue[i] = place[i];
            this.propsModelValue.id = id;
            this.placeSave.submit();
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
                    this.placeUpdate(resp.data[0]);
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
            });
        },
    },

    async mounted() {
        this.placeFind();
    },

    data() {
        return {
            places: useAxios({
                method: 'get',
                url: '/api/places/place-search',
                params: {q:'rua dos americanos milionários'},
                submit: true,
                resp: [],
            }),
            placeSave: useAxios({
                method: 'post',
                url: '/api/places/save',
                data: {},
                onSubmit: (placeSave) => {
                    placeSave.data = this.propsModelValue;
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
};
</script>