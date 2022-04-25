<template>
    <div class="ui-place">
        <div class="form-control" @click="modal=true">Endereço</div>

        <ui-modal v-model="modal" width="600px">
            <template #header>Endereço</template>
            <template #body>
                <div class="row">
                    <div class="mb-3 col-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="CEP" v-model="address.zipcode">
                            <label>CEP</label>
                        </div>
                    </div>
        
                    <div class="col-12"></div>
        
                    <div class="mb-3 col-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Rua" v-model="address.route">
                            <label>Rua</label>
                        </div>
                    </div>
                    
                    <div class="mb-3 col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Número" v-model="address.number">
                            <label>Número</label>
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Rua" v-model="address.complement">
                            <label>Complemento</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Bairro" v-model="address.district">
                            <label>Bairro</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Cidade" v-model="address.city">
                            <label>Cidade</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Estado" v-model="address.state">
                            <label>Estado</label>
                        </div>
                    </div>
        
                    <div class="mb-3 col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="País" v-model="address.country">
                            <label>País</label>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <button type="button" class="btn btn-primary">
                    Salvar
                </button>
            </template>
        </ui-modal>

        <pre>$data: {{ $data }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:"", type:[Boolean, Number, String]},
    },

    data() {
        return {
            modal: false,
            address: {},
            props: JSON.parse(JSON.stringify(this.$props)),
        };
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
}
</script>