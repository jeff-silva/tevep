<template>
	<ui-model-edit
		model-name="places"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, validate}"
	>
		<ui-place-form :place="value" @update:place="placeMerge(value, $event)"></ui-place-form>
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
		placeMerge(value, merge={}) {
			for(let i in merge) {
				value[i] = merge[i];
			}
		},
	},
}
</script>