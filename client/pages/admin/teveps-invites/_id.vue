<template>
	<ui-model-edit
		model-name="teveps-invites"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, validate}"
	>
		<ui-field label="Nome" :validate="validate.test('name')">
			<input type="text" class="form-control" v-model="value.name">
		</ui-field>
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