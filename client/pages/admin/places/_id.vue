<template>
	<ui-model-edit
		model-name="places"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
	>
		<ui-field label="Nome" :error="errorFields.name">
			<input type="text" class="form-control" v-model="value.name">
		</ui-field>

		<ui-field label="Rua" :error="errorFields.route">
			<input type="text" class="form-control" v-model="value.route">
		</ui-field>
		
		<ui-field label="Número" :error="errorFields.route">
			<input type="text" class="form-control" v-model="value.number">
		</ui-field>

		<ui-field label="Complemento" :error="errorFields.complement">
			<input type="text" class="form-control" v-model="value.complement">
		</ui-field>

		<ui-field label="CEP" :error="errorFields.zipcode">
			<input type="text" class="form-control" v-model="value.zipcode">
		</ui-field>

		<ui-field label="Bairro" :error="errorFields.district">
			<input type="text" class="form-control" v-model="value.district">
		</ui-field>

		<ui-field label="Cidade" :error="errorFields.city">
			<input type="text" class="form-control" v-model="value.city">
		</ui-field>

		<ui-field label="Cidade" :error="errorFields.state">
			<input type="text" class="form-control" v-model="value.state">
		</ui-field>
	</ui-model-edit>
</template>

<script>
export default {
	head() {
		return {
			title: "Editar endereço",
		};
	},

	methods: {
		mergePlace(value, merge={}) {
			for(let i in merge) {
				value[i] = merge[i];
			}
		},
	},
}
</script>