<template><div>
    <ui-table v-bind.sync="tevep" :select="false" :loading="loading">
        <template #header>
            <th>Projeto</th>
            <th>Quando</th>
            <th>Dono</th>
            <th>Alteração</th>
        </template>

        <template #item="{item}">
            <td>{{ item.title }}</td>
            <td>
                <div>De &nbsp; {{ item.date_start|datetime }}</div>
                <div>Até {{ item.date_final|datetime }}</div>
            </td>
            <td>{{ item.user.name }}</td>
            <td><ui-timeago v-model="item.updated_at"></ui-timeago></td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/admin/tevep/${item.id}/`" class="btn btn-primary"><i class="fas fa-fw fa-pen"></i></nuxt-link>
            <a href="javascript:;" class="btn btn-danger" @click="tevepDelete(item)"><i class="fas fa-fw fa-times"></i></a>
        </template>
    </ui-table>

    <ui-actions>
        <nuxt-link to="/tevep/0/" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i> Criar
        </nuxt-link>
    </ui-actions>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            loading: false,
            tevep: {data:[]},
            tevepSearchParams: {
                search: '',
            },
        };
    },

    methods: {
        searchTevep() {
            this.loading = true;
            this.$axios.get('/api/tevep/me', {params:this.tevepSearchParams}).then(resp => {
                this.tevep = resp.data;
                this.loading = false;
            });
        },

        tevepDelete(tevep) {
            this.$swal('Confirmação', `Deseja mesmo deletar o projeto "${tevep.title}"?`).then(resp => {
                if (! resp.value) return;
                this.$axios.post(`/api/tevep/${tevep.id}/delete`).then(resp => {
                    this.$swal('Sucesso', 'Projeto deletado', 'success');
                    this.searchTevep();
                });
            });
        },
    },

    mounted() {
        this.searchTevep();
    },
}
</script>