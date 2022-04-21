<template>
	<ui-model-search
		model-name="users-groups"
		singular="Item"
		plural="Itens"
		:actions-except="['delete']"
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
			title: "Buscar",
		};
	},
}
</script>