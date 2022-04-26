<template>
	<ui-model-search
		model-name="places"
		singular="Item"
		plural="Itens"
		:actions-except="['clone', 'delete']"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
		</template>
		
		<template #table-row="{item}">
			<td>{{ item.formatted }}</td>
		</template>
	</ui-model-search>
</template>

<script>
export default {
	head() {
		return {
			title: "Buscar endereços",
		};
	},
}
</script>