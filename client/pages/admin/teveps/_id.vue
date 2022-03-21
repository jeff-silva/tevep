<template>
	<ui-model-edit
		model-name="teveps"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
		@model-loaded="$store.state.tevep.edit=$event"
	>
		<ui-field label="Nome" :error="errorFields.name">
			<input type="text" class="form-control" v-model="$store.state.tevep.edit.name">
		</ui-field>

		<div class="d-flex">
			<nuxt-link class="btn btn-light me-2" :to="`/admin/teveps/${$route.params.id}/`">Principal</nuxt-link>
			<nuxt-link class="btn btn-light me-2" :to="`/admin/teveps/${$route.params.id}/test`">Test</nuxt-link>
		</div>

		<nuxt-child></nuxt-child>
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