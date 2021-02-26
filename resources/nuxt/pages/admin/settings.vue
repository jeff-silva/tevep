<template><div>
    <div v-if="loading>0">Carregando...</div>

    <ui-form v-else method="post" action="/api/settings/save/" v-model="settings" #default="{loading, success, error}" @success="success($event)">
        <div class="row no-gutters">
            <div class="col-12 col-md-3 bg-white shadow-sm mb-3 mb-md-0">
                <div class="list-group list-group-flush">
                    <nuxt-link :to="n.to" class="list-group-item" v-for="n in navs" :key="n.id">{{ n.title }}</nuxt-link>
                </div>
            </div>
            <div class="col-12 col-md-9 pl-md-3">
                <div class="bg-secondary p-2" v-for="n in navs" v-if="n.to==$route.path">{{ n.subtitle }}</div>
                <nuxt-child v-model="settings" :error="error" class="bg-white p-2 pt-3 shadow-sm"></nuxt-child>
            </div>
        </div>

        <ui-actions>
            <button type="submit" class="btn btn-primary">
                <div v-if="loading"><span v-html="loading"></span> Salvando</div>
                <div v-else><i class="fas fa-save"></i> Salvar</div>
            </button>
        </ui-actions>
    </ui-form>
</div></template>

<script>
export default {
    middleware: 'auth',
    layout: 'admin',

    data() {
        return {
            loading: 0,
            settings: {},

            navs: [
                {
                    id: "email",
                    title: "E-mail",
                    subtitle: "Configurações de e-mail",
                    to: "/admin/settings/email",
                },
            ],
        };
    },

    methods: {
        getSettings() {
            this.loading++;
            this.$axios.get('/api/settings').then(resp => {
                this.loading--;
                this.settings = resp.data;
            });
        },

        success(settings) {
            this.settings = settings;
            this.$swal('Sucesso', 'Configurações salvas', 'success');
        },
    },

    mounted() {
        this.getSettings();
    },
}
</script>