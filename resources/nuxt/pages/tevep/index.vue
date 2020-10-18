<template><div>
	<!-- <app-footer>
		<template #content>
			<nuxt-link to="/tevep/0" class="btn btn-primary">
				<i class="fa fa-fw fa-plus"></i> Novo projeto
			</nuxt-link>
		</template>
	</app-footer> -->

    <ui-laravel-table v-model="tevep" resource="tevep" :search-params="{user_id:$user('id')}">
        <template #empty>Nenhum projeto encontrado</template>

        <template #item="{item}">
            <td>{{ item.title||item.id }}</td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/tevep/${item.id}/`" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></nuxt-link>
            <nuxt-link :to="`/tevep/${item.id}/`" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i></nuxt-link>
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
}
</script>