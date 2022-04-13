<template>
	<ui-model-search
		model-name="teveps"
		singular="Item"
		plural="Itens"
	>
		<template #table-header>
			<th data-orderby="name">Nome</th>
			<th data-orderby="date_start">Datas</th>
		</template>
		
		<template #table-row="{item}">
			<td>
				<div>{{ item.name }}</div>
				<small class="d-block text-muted" v-if="item.parent_id">(Filho)</small>
			</td>
			<td>
				<div style="white-space:pre;">De   {{ item.date_start|dateFormat }}</div>
				<div style="white-space:pre;">Até  {{ item.date_final|dateFormat }}</div>
			</td>
		</template>
	</ui-model-search>
</template>

<script>
export default {
	layout: "admin",
	middleware: ["auth", "permission"],
	
	head() {
		return {
			title: "Buscar",
		};
	},
}
</script>