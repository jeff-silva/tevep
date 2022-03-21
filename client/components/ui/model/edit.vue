<template>
    <ui-form method="post"
        :action="`/api/${modelName}/save`"
        v-model="props.value"
        #default="{loading, error, errorFields}"
        @success="onSuccess"
    >
        <div class="ui-model-edit-fields bg-white p-3 shadow-sm">
            <el-collapse-transition>
                <div class="alert alert-danger" v-if="error">
                    <a href="javascript:;" class="float-end text-danger fw-bold" @click="error=false">
                        <i class="fas fa-fw fa-times"></i>
                    </a>
                    <div v-html="error"></div>
                </div>
            </el-collapse-transition>

            <slot :value="props.value" :loading="loading" :error="error" :errorFields="errorFields"></slot>
        </div>

        <div class="ui-model-edit-actions text-end bg-white shadow-sm py-2 mt-md-3 p-md-3" v-if="showActions">
            <slot name="actions"></slot>

            <nuxt-link :to="`/admin/${modelName}/new`" class="btn btn-light" v-if="props.value.id">
                Criar {{ singular }}
            </nuxt-link>

            <nuxt-link :to="backUrl" class="btn btn-light">
                Voltar
            </nuxt-link>

            <button type="submit" class="btn btn-primary" v-loading="loading">
                Salvar
            </button>
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
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    computed: {
        _modelId() {
            let modelId = +this.props.modelId;
            if (typeof this.props.value=="object" && this.props.value.id) {
                modelId = +this.props.value.id;
            }
            return isNaN(modelId)? false: modelId;
        },
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
            if (!this._modelId) return;
            this.finding = true;
            this.$axios.get(`/api/${this.modelName}/find/${this._modelId}`).then(resp => {
                this.finding = false;
                this.props.value = resp.data;
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


<style>
@media (max-width: 768px) {
    .ui-model-edit-fields {
        margin-bottom: 50px;
    }

    .ui-model-edit-actions {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        display: flex;
    }

    .ui-model-edit-actions > .btn {
        flex-basis: 100%;
        text-align: center;
        margin-left: 5px;
        margin-right: 5px;
    }
}
</style>