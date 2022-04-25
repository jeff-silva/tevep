<template>
    <div class="ui-place">
        <div class="form-control" @click="modal=true">{{ place.formatted || 'Sem endereço' }}</div>

        <ui-modal v-model="modal" width="600px">
            <template #header>Endereço</template>
            <template #body>
                <div class="row">
                    <div class="mb-3 col-12">
                        <ui-autocomplete action="/api/places/place-search" :params="{search:search}">
                            <template #default="ac">
                                <div class="input-group">
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-end-0" placeholder="Busca" v-model="search">
                                        <label>Busca</label>
                                    </div>
                                    <div class="input-group-text bg-transparent border-start-0">
                                        <i class="fas fa-fw fa-spin fa-spinner" v-if="ac.loading"></i>
                                        <i class="fas fa-fw fa-search" v-else></i>
                                    </div>
                                </div>
                            </template>

                            <template #response="{ response }">
                                <div class="list-group shadow-sm">
                                    <a href="javascript:;" class="list-group-item" v-for="r in response" @click="place=r">
                                        {{ r.route }}, {{ r.city }}, {{ r.state_short }}
                                    </a>
                                </div>
                            </template>
                        </ui-autocomplete>
                    </div>
        
                    <div class="mb-3 col-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Rua" v-model="place.route">
                            <label>Rua</label>
                        </div>
                    </div>
                    
                    <div class="mb-3 col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Número" v-model="place.number">
                            <label>Número</label>
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="CEP" v-model="place.zipcode">
                            <label>CEP</label>
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Rua" v-model="place.complement">
                            <label>Complemento</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Bairro" v-model="place.district">
                            <label>Bairro</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Cidade" v-model="place.city">
                            <label>Cidade</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Estado" v-model="place.state">
                            <label>Estado</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="País" v-model="place.country">
                            <label>País</label>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <button type="button" class="btn btn-primary" @click="placeSave()">
                    Salvar
                </button>
            </template>
        </ui-modal>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:"", type:[Boolean, Number, String]},
    },

    data() {
        return {
            search: "",
            modal: false,
            place: {},
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.placeFind();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    methods: {
        placeSave() {
            this.$axios.post('/api/places/save', this.place).then(resp => {
                this.props.value = resp.data.id;
                this.modal = false;
                this.placeFind();
            });
        },
        
        placeFind() {
            if (! this.props.value) return;
            this.$axios.get(`/api/places/find/${this.props.value}`).then(resp => {
                this.place = resp.data;
            });
        },
    },
}
</script>