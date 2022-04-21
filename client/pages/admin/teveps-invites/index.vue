<template>
	<ui-model-search
		model-name="teveps-invites"
		singular="Item"
		plural="Itens"
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