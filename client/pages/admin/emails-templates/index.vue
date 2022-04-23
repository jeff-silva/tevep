<template>
	<ui-model-search
		model-name="emails-templates"
		singular="Item"
		plural="Itens"
		:actions-except="['clone', 'delete']"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
		</template>
		
		<template #table-row="{item}">
			<td>{{ item.name }}</td>
		</template>
	</ui-model-search>
</template>

<script>
export default {
	head() {
		return {
			title: "Buscar templates de e-mail",
		};
	},
}
</script>