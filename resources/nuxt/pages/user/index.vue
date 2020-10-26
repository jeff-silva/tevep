<template><div class="container">
    <h1>Usuários</h1>
    <ui-laravel-table v-model="user.resp">
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
    <pre>{{ $data }}</pre>
</div></template>

<script>
export default {
    layout: 'admin',

    methods: {
        userSearch() {
            this.$axios.get('/api/user/search').then((resp) => {
                this.user.resp = resp.data;
            });
        },
    },

    data() {
        return {
            user: {
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
