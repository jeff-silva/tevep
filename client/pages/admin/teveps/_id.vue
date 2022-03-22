<template>
	<ui-model-edit
		model-name="teveps"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
		@model-loaded="$store.state.tevep.edit=$event"
	>
		<tevep-edit></tevep-edit>
	</ui-model-edit>
</template>

<script>
export default {
	layout: "default/admin",
	middleware: ["auth", "permission"],
	
	head() {
		return {
			title: "Editar",
		};
	},
}
</script>