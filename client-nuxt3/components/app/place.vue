<template>
    <div>
        <v-row>
            <v-col cols="12">
                
                <v-menu>
                    <template #activator="activator">
                        <v-text-field
                            v-bind="activator.props"
                            :hide-details="true"
                            :label="props.modelValue.name||'Busca'"
                            prepend-icon="mdi-magnify"
                            v-model="search.params.search"
                            @keyup="search.submit({debounce:1000})"
                        ></v-text-field>
                        <v-progress-linear
                            indeterminate
                            v-if="search.loading"
                        ></v-progress-linear>
                    </template>

                    <v-card v-if="search.resp" style="margin: 10px 0 0 -15px;">
                        <v-list>
                            <v-list-item v-if="search.resp.length==0">
                                Nenhum resultado encontrado
                            </v-list-item>
                            <template v-for="p in (search.resp||[])">
                                <v-list-item style="cursor:pointer;" @click="placeUpdate(p)">
                                    {{ [p.route, p.district, p.city, p.state, p.country].filter(item => item).join(', ') }}
                                </v-list-item>
                            </template>
                        </v-list>
                    </v-card>
                </v-menu>

            </v-col>
            <v-col cols="12" lg="8"><v-text-field :hide-details="true" label="Rua" v-model="propsModelValue.route"></v-text-field></v-col>
            <v-col cols="6" lg="4"><v-text-field :hide-details="true" label="Nº" v-model="propsModelValue.number"></v-text-field></v-col>
            <v-col cols="6" lg="6"><v-text-field :hide-details="true" label="Complemento" v-model="propsModelValue.complement"></v-text-field></v-col>
            <v-col cols="12" lg="6"><v-text-field :hide-details="true" label="CEP" v-model="propsModelValue.zipcode"></v-text-field></v-col>
            <v-col cols="12" lg="4"><v-text-field :hide-details="true" label="Bairro" v-model="propsModelValue.district"></v-text-field></v-col>
            <v-col cols="12" lg="4"><v-text-field :hide-details="true" label="Cidade" v-model="propsModelValue.city"></v-text-field></v-col>
            <v-col cols="12" lg="4"><v-text-field :hide-details="true" label="Estado" v-model="propsModelValue.state"></v-text-field></v-col>

            <v-col cols="12">
                <l-map ref="map" :zoom="18" :center="[(propsModelValue.lat||0), (propsModelValue.lng||0)]" style="height:350px;">
                    <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                    <l-marker :lat-lng="[(propsModelValue.lat||0), (propsModelValue.lng||0)]" :draggable="true" @update:lat-lng="updateLatLng($event)"></l-marker>
                </l-map>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: {
        value: {type:[Boolean, Object], default:()=>({})},
        modelValue: {type:[Boolean, Object], default:()=>({})},
    },

    // emits: ['update:modelValue'],

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            search: useAxios({url:'/api/places/place-search', params:{search:'', lat:null, lng:null}}),
        };
    },

    methods: {
        placeUpdate(place={}) {
            let id = this.modelValue.id || null;
            this.propsModelValue = {...place, id};
        },

        mapRecenter() {
            // setTimeout(() => {
            //     this.$refs.map.mapObject.panTo([
            //         parseFloat(this.props.place.lat||0),
            //         parseFloat(this.props.place.lng||0),
            //     ]);
            // }, 100);
        },

        updateLatLng(coords) {
            if (!this._ignoreFirstUpdateLatLng) {
                this._ignoreFirstUpdateLatLng = true;
                this.mapRecenter();
                return;
            }

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
    },
}
</script>