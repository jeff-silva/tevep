<template><div>
	<!-- <app-footer>
		<template #content>
			<nuxt-link to="/tevep/0" class="btn btn-primary">
				<i class="fa fa-fw fa-plus"></i> Novo projeto
			</nuxt-link>
		</template>
	</app-footer> -->

    <ui-laravel-table v-model="tevep">
        <template #empty>Nenhum projeto encontrado</template>

        <template #item="{item}">
            <td>{{ item.title||item.id }}</td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/tevep/${item.id}/`" class="btn btn-primary"><i class="fas fa-edit"></i></nuxt-link>
            <a href="javascript:;" class="btn btn-danger" @click="tevepsDelete(item)"><i class="fas fa-times"></i></a>
        </template>
    </ui-laravel-table>
</div></template>

<script>
export default {
	layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            tevep: {},
        };
    },

    methods: {
        tevepsSearch() {
            let user_id = this.$route.query.user || this.$auth.user.id;
            this.$axios.get('/api/tevep/search', {params:{user_id}}).then(resp => {
                this.tevep = resp.data;
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