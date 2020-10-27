<template><div>
    <h1>Usuários</h1>
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
