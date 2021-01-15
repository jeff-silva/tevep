<template><div>
    <div class="text-right mb-3">
        <button type="button" class="btn btn-primary" @click="user.edit={}">
            <i class="fa fa-fw fa-plus"></i> Novo usuário
        </button>
    </div>

    <ui-modal v-model="user.edit">
        <template #header>
            {{ user.edit.name || 'Criar'}}
        </template>
        <template #body>
            <ui-auth-register v-model="user.edit" @success="user.edit=false; userSearch();"></ui-auth-register>
        </template>
    </ui-modal>

    <div class="text-center" v-if="user.loading">
        Carregando...
    </div>

    <div class="row">
        <div class="col-12 col-md-3 mb-5" v-for="u in user.resp.data" :key="u.id" style="position:relative;">
            <user-card :value="u" style="position:relative; height:100%;">
                <template #actions>
                    <nuxt-link :to="`/user/${u.id}`" class="btn btn-light" v-tooltip.top-center="'Editar'"><i class="fas fa-edit"></i></nuxt-link>
                    <nuxt-link :to="`/tevep/?user=${u.id}`" class="btn btn-light" v-tooltip.top-center="'Projetos'"><i class="fas fa-shopping-bag"></i></nuxt-link>
                </template>
            </user-card>
        </div>
    </div>
</div></template>

<script>
export default {
    layout: 'admin',

    methods: {
        userSearch() {
            this.user.loading = true;
            this.$axios.get('/api/user/search').then((resp) => {
                this.user.loading = false;
                this.user.resp = resp.data;
            });
        },
    },

    data() {
        return {
            user: {
                loading: false,
                edit: false,
                params: {},
                resp: {},
            },
        }
    },

    mounted() {
        this.userSearch();
    },
}
</script>
