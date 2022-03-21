<template>
	<ui-model-edit
		model-name="teveps"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
	>
		<ui-field label="Nome" :error="errorFields.name">
			<input type="text" class="form-control" v-model="value.name">
		</ui-field>
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