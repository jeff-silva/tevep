<template>
    <div class="row">
        <div class="mb-3 col-12">
            <ui-autocomplete action="/api/places/place-search" :params="autocomplete.params">
                <template #default="ac">
                    
                    <ui-field-float :label="props.place.formatted||'Buscar'">
                        <input type="text" class="form-control border-end-0" placeholder="Buscar" v-model="autocomplete.params.search">

                        <template #append>
                            <div class="input-group-text bg-transparent border-start-0" v-if="props.place.formatted">
                                <a href="javascript:;" class="text-dark" @click="placeClear()">
                                    <i class="fas fa-fw fa-times"></i>
                                </a>
                            </div>
                            <div class="input-group-text bg-transparent border-start-0" v-else>
                                <i class="fas fa-fw fa-spin fa-spinner" v-if="ac.loading"></i>
                                <i class="fas fa-fw fa-search" v-else></i>
                            </div>
                        </template>
                    </ui-field-float>
                </template>

                <template #response="{ response }">
                    <div class="list-group shadow-sm">
                        <a href="javascript:;" class="list-group-item" v-for="r in response" @click="props.place=r">
                            {{ r.route }}, {{ r.city }}, {{ r.state_short }}
                        </a>
                    </div>
                </template>
            </ui-autocomplete>
        </div>

        <!-- <div class="mb-3 col-12">
            <ui-field-float label="Descrição do endereço">
                <input type="text" class="form-control" placeholder="Descrição do endereço" v-model="props.place.name">
            </ui-field-float>
        </div> -->

        <div class="mb-3 col-8 col-md-9">
            <ui-field-float label="Rua">
                <input type="text" class="form-control" placeholder="Rua" v-model="props.place.route">
            </ui-field-float>
        </div>
        
        <div class="mb-3 col-4 col-md-3">
            <ui-field-float label="Número">
                <input type="text" class="form-control" placeholder="Número" v-model="props.place.number">
            </ui-field-float>
        </div>

        <div class="mb-3 col-12">
            <ui-field-float label="Complemento">
                <input type="text" class="form-control" placeholder="Rua" v-model="props.place.complement">
            </ui-field-float>
        </div>

        <div class="mb-3 col-6 col-md-6">
            <ui-field-float label="CEP">
                <input type="text" class="form-control" placeholder="CEP" v-model="props.place.zipcode">
            </ui-field-float>
        </div>

        <div class="mb-3 col-6 col-md-6">
            <ui-field-float label="Bairro">
                <input type="text" class="form-control" placeholder="Bairro" v-model="props.place.district">
            </ui-field-float>
        </div>

        <div class="mb-3 col-12 col-md-6">
            <ui-field-float label="Cidade">
                <input type="text" class="form-control" placeholder="Cidade" v-model="props.place.city">
            </ui-field-float>
        </div>

        <div class="mb-3 col-6 col-md-3">
            <ui-field-float label="Estado">
                <input type="text" class="form-control" placeholder="Estado" v-model="props.place.state">
            </ui-field-float>
        </div>

        <div class="mb-3 col-6 col-md-3">
            <ui-field-float label="País">
                <input type="text" class="form-control" placeholder="País" v-model="props.place.country">
            </ui-field-float>
        </div>
        
        <div class="col-12">
            <l-map ref="map" :zoom="21" :center="[parseFloat(props.place.lat||0), parseFloat(props.place.lng||0)]" style="height:350px;">
                <l-tile-layer url="http://{s}.tile.osm.org/{z}/{x}/{y}.png"></l-tile-layer>
                <l-marker :lat-lng="[parseFloat(props.place.lat||0), parseFloat(props.place.lng||0)]" :draggable="true" @update:lat-lng="updateLatLng($event)"></l-marker>
            </l-map>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        place: {type:Object, default:()=>({})},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.mapRecenter();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            autocomplete: {
                params: {
                    search: "",
                },
            },
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        placeClear() {
            let id = this.props.place.id || null;
            this.props.place = {id};
        },

        mapRecenter() {
            setTimeout(() => {
                this.$refs.map.mapObject.panTo([
                    parseFloat(this.props.place.lat||0),
                    parseFloat(this.props.place.lng||0),
                ]);
            }, 100);
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
                    this.props.place = resp.data[0];
                });
            }, 500);
        },
    },
}
</script>