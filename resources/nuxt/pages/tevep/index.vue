<template><div>
	<!-- <app-footer>
		<template #content>
			<nuxt-link to="/tevep/0" class="btn btn-primary">
				<i class="fa fa-fw fa-plus"></i> Novo projeto
			</nuxt-link>
		</template>
	</app-footer> -->

    <ui-table v-bind="tevep" :loading="loading" :select="false" @page-change="tevepParams.page=$event.current_page; tevepsSearch();">
        <template #empty>
            Nenhum dado encontrado
        </template>

        <template #header>
            <th>Evento</th>
            <th width="200px">Últ. alteração</th>
        </template>

        <template #item="{item}">
            <td>#{{ item.id }} {{ item.title }}</td>
            <td><ui-timeago v-model="item.updated_at"></ui-timeago></td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/tevep/${item.id}/`" class="btn btn-primary"><i class="fas fa-edit"></i></nuxt-link>
            <a href="javascript:;" class="btn btn-danger" @click="tevepsDelete(item)"><i class="fas fa-times"></i></a>
        </template>
    </ui-table>
</div></template>

<script>
export default {
	layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            loading: false,
            tevepParams: {
                page: 1,
                user_id: (this.$route.query.user || this.$auth.user.id),
            },
            tevep: {
                data: [],
            },
        };
    },

    methods: {
        tevepsSearch() {
            this.loading = true;
            this.$axios.get('/api/tevep/search', {params:this.tevepParams}).then(resp => {
                this.tevep = resp.data;
                this.loading = false;
            });
        },

        tevepsDelete(tevep) {
            if (!confirm('Deseja deletar?')) return;
            this.$axios.post(`/api/tevep/delete/${tevep.id}`).then(resp => {
                this.$swalSuccess('Sucesso', 'Projeto deletado');
                this.tevepsSearch();
            });
        },
    },

    mounted() {
        this.tevepsSearch();
    },
}
</script>