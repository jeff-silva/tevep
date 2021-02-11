<template><div>

    <nuxt-link to="/tevep2/0/">Criar</nuxt-link>
    <!-- <nuxt-child></nuxt-child> -->

    <ui-table v-bind.sync="tevep">
        <template #header>
            <th>Projeto</th>
        </template>

        <template #item="{item}">
            <td>{{ item.name }}</td>
        </template>
    </ui-table>

    <pre>$data: {{ $data }}</pre>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            tevep: {data:[]},
        };
    },

    methods: {
        searchTevep() {
            this.$axios.get('/api/tevep/search').then(resp => {
                this.tevep = resp.data;
            });
        },
    },

    mounted() {
        this.searchTevep();
    },
}
</script>