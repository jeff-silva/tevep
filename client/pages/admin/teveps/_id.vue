<template>
	<ui-model-edit
		model-name="teveps"
		:model-id="$route.params.id"
		v-model="$store.state.tevep.edit"
		singular="Item"
		plural="Itens"
		#default="{value, validate}"
	>
		<tevep-edit></tevep-edit>
	</ui-model-edit>
</template>

<script>
export default {
	head() {
		return {
			title: "Editar",
		};
	},
}
</script>