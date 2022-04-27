<template>
	<ui-model-search
		model-name="places"
		singular="Item"
		plural="Itens"
		:actions-except="['clone', 'delete']"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
			<th data-orderby="city">Localidade</th>
		</template>
		
		<template #table-row="{item}">
			<td>{{ item.formatted }}</td>
			<td>{{ [item.city, item.state_short, item.country].filter(item => item).join('/') }}</td>
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