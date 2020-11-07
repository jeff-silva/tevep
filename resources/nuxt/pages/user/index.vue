<template><div>
    
    <!--
    <ui-laravel-table v-model="user.resp" v-bind="{loading:user.loading}">
        <template #item="{item}">
            <td>
                <div><strong>{{ item.name }}</strong></div>
                <div><small class="text-muted">{{ item.email }}</small></div>
            </td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/user/${item.id}`" class="btn btn-primary">
                <i class="fas fa-edit"></i>
            </nuxt-link>
        </template>
    </ui-laravel-table>
    -->

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
        <div class="col-12 col-md-4 mb-5" v-for="u in user.resp.data" :key="u.id">
            <user-card :value="u">
                <template #actions>
                    <button type="button" class="btn btn-light" @click="user.edit=u">Editar</button>
                    <nuxt-link :to="`/tevep/?user=${u.id}`" class="btn btn-light">Projetos</nuxt-link>
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
