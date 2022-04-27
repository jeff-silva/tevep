<template>
    <ui-form method="post"
        :action="`/api/${modelName}/save`"
        :params="props.value"
        #default="{loading, error, validate}"
        @success="onSuccess"
        :validationRules="validationRules"
    >
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="bg-white p-3">
                    <el-collapse-transition>
                        <div class="alert alert-danger" v-if="error">
                            <a href="javascript:;" class="float-end text-danger fw-bold" @click="error=false">
                                <i class="fas fa-fw fa-times"></i>
                            </a>
                            <div v-html="error"></div>
                        </div>
                    </el-collapse-transition>
    
                    <slot :value="props.value" :loading="loading" :error="error" :validate="validate"></slot>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-3 mt-md-0">
                <div class="bg-white p-3">
                    <slot name="actions" :value="props.value" :loading="loading" :error="error" :validate="validate"></slot>
    
                    <nuxt-link :to="`/admin/${modelName}/new`" class="btn btn-light w-100" v-if="props.value.id">
                        Criar {{ singular }}
                    </nuxt-link>
    
                    <nuxt-link :to="backUrl" class="btn btn-light w-100 mt-3">
                        Voltar
                    </nuxt-link>
    
                    <button type="submit" class="btn btn-primary w-100 mt-3" v-loading="loading" :disabled="validate.invalid">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    </ui-form>
</template>

<script>
export default {
    props: {
        value: {default:()=>({}), type:[Boolean, Number, String, Object]},
        modelName: {default:""},
        modelId: {default:false, type:[Boolean, Number, String]},
        singular: {default:"Item"},
        plural: {default:"Itens"},
        showActions: {default:true}, // exibir botões de ação (criar, voltar, salvar) do formulário?
        redirect: {default:"edit"}, // edit=/admin/{model}/{model.id}; back=pagina anterior; qualquer outro valor=url direta
        validationRules: {default:false, type:[Boolean, Object, Function]},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            let oldModelId = this.props.modelId;
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
            if (this.props.modelId!=oldModelId) { this.find(); }
        }},
    },

    data() {
        return {
            finding: false,
            backUrl: (localStorage.getItem(`ui-model-search-${this.modelName}-url`) || ''),
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        find() {
            let modelId = +this.props.modelId;
            if (isNaN(modelId)) {
                this.props.value = {};
                this.$emit('input', this.props.value);
                return;
            }

            this.finding = true;
            this.$axios.get(`/api/${this.modelName}/find/${this.modelId}`).then(resp => {
                this.finding = false;
                this.props.value = resp.data;
                this.$emit('input', resp.data);
                this.$emit('model-loaded', resp.data);
            }).catch(err => {
                this.props.value = {};
                this.$emit('input', {});
            });
        },

        onSuccess(respData) {
            this.props.value = respData;
            this.$emit('success', respData);
            
            this.$swal.fire({
                title: `Dados de ${this.singular} foram salvos`,
                confirmButtonText: `Lista de ${this.plural}`,
                showCancelButton: true,
                cancelButtonText: `Fechar`,
            }).then(resp => {
                if (!resp.isConfirmed) return;
                this.$router.push(this.backUrl);
            });

            this.$router.push(`/admin/${this.modelName}/${respData.id}`);
        },

        successRedirect() {
            if (this.redirect=="edit") {
                this.$router.push(`/admin/${this.modelName}/${this.props.value&&this.props.value.id? this.props.value.id: 'new'}`);
            }
            else if (this.redirect=="back") {
                this.$router.go(-1);
            }
            else {
                this.$router.push(this.redirect);
            }
        },
    },

    mounted() {
        this.find();
    },
}
</script>