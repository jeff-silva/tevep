<template>
    <div class="row">
        <div class="mb-3 col-12">
            <ui-autocomplete action="/api/places/place-search" :params="autocomplete.params">
                <template #default="ac">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control border-end-0" placeholder="Buscar" v-model="autocomplete.params.search">
                            <label>{{ props.place.formatted||'Buscar' }}</label>
                        </div>
                        <div class="input-group-text bg-transparent border-start-0" v-if="props.place.formatted">
                            <a href="javascript:;" class="text-dark" @click="placeClear()">
                                <i class="fas fa-fw fa-times"></i>
                            </a>
                        </div>
                        <div class="input-group-text bg-transparent border-start-0" v-else>
                            <i class="fas fa-fw fa-spin fa-spinner" v-if="ac.loading"></i>
                            <i class="fas fa-fw fa-search" v-else></i>
                        </div>
                    </div>
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
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Descrição do endereço" v-model="props.place.name">
                <label>Descrição do endereço</label>
            </div>
        </div> -->

        <div class="mb-3 col-8 col-md-9">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Rua" v-model="props.place.route">
                <label>Rua</label>
            </div>
        </div>
        
        <div class="mb-3 col-4 col-md-3">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Número" v-model="props.place.number">
                <label>Número</label>
            </div>
        </div>

        <div class="mb-3 col-12">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Rua" v-model="props.place.complement">
                <label>Complemento</label>
            </div>
        </div>

        <div class="mb-3 col-6 col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="CEP" v-model="props.place.zipcode">
                <label>CEP</label>
            </div>
        </div>

        <div class="mb-3 col-6 col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Bairro" v-model="props.place.district">
                <label>Bairro</label>
            </div>
        </div>

        <div class="mb-3 col-12 col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Cidade" v-model="props.place.city">
                <label>Cidade</label>
            </div>
        </div>

        <div class="mb-3 col-6 col-md-3">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Estado" v-model="props.place.state">
                <label>Estado</label>
            </div>
        </div>

        <div class="mb-3 col-6 col-md-3">
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="País" v-model="props.place.country">
                <label>País</label>
            </div>
        </div>
        
        <div class="col-12">
            <l-map :zoom="21" :center="[parseFloat(props.place.lat||0), parseFloat(props.place.lng||0)]" style="height:300px;">
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

        updateLatLng(coords) {
            // coords = JSON.parse(JSON.stringify(coords));
            // console.log(coords);
            this.$axios.get('/api/places/place-search', {params:coords}).then(resp => {
                if (!resp.data[0]) return;
                this.props.place = resp.data[0];
            });
        },
    },
}
</script>