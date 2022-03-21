<!-- TODO: criar uma maneira de enviar e-mails de teste utilizando coluna "models" para selecionar items para teste -->
<template>
	<ui-model-edit
		model-name="emails-templates"
		:model-id="$route.params.id"
		singular="Item"
		plural="Itens"
		#default="{value, errorFields}"
	>
		<ui-field label="Nome" :error="errorFields.name">
			<input type="text" class="form-control" v-model="value.name">
		</ui-field>

		<ui-field label="Assunto" :error="errorFields.subject">
			<input type="text" class="form-control" v-model="value.subject">
		</ui-field>

		<ui-field label="Corpo do e-mail" :error="errorFields.body">
			<ui-html v-model="value.body" ref="body">
				<template #footer="editor">
					<el-collapse-transition>
						<div class="mt-2" v-if="value.params && editor.info.focus">
							<div class="fw-bold mb-1">Variáveis</div>
							<a href="javascript:;" class="badge rounded-pill bg-primary me-1 mb-1" :title="p.source" v-for="p in value.params" @click="$refs.body.appendValue(p.source)">
								{{ p.name }}
							</a>
						</div>
					</el-collapse-transition>
				</template>
			</ui-html>
		</ui-field>
	</ui-model-edit>
</template>

<script>
export default {
	layout: "default/admin",
	middleware: ["auth", "permission"],
	
	head() {
		return {
			title: "Editar template de e-mail",
		};
	},
}
</script>