<template>
	<ui-model-edit
		model-name="teveps"
		:model-id="$route.params.id"
		v-model="$store.state.tevep.edit"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
	>
		<tevep-edit></tevep-edit>
	</ui-model-edit>
</template>

<script>
export default {
	layout: "admin",
	middleware: ["auth", "permission"],
	
	head() {
		return {
			title: "Editar",
		};
	},
}
</script>