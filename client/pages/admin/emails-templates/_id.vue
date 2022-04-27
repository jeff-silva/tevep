<!-- TODO: criar uma maneira de enviar e-mails de teste utilizando coluna "models" para selecionar items para teste -->
<template>
	<div>
		<ui-model-edit
			model-name="emails-templates"
			:model-id="$route.params.id"
			singular="Item"
			plural="Itens"
		>
			<template #default="{value, validate}">
				<ui-field label="Nome" :validate="validate.test('name')">
					<input type="text" class="form-control" v-model="value.name">
				</ui-field>
		
				<ui-field label="Assunto" :validate="validate.test('subject')">
					<input type="text" class="form-control" v-model="value.subject">
				</ui-field>
		
				<ui-field label="Corpo do e-mail" :validate="validate.test('body')">
					<ui-html v-model="value.body" ref="body"></ui-html>
		
					<div class="mt-2 list-inline" v-if="value.params">
						<div class="list-inline-item fw-bold">Variáveis</div>
						<div class="list-inline-item" v-for="p in value.params">
							<a href="javascript:;" class="badge rounded-pill bg-primary me-1 mb-1" :title="p.source" @click="$refs.body.appendValue(p.source)">
								{{ p.name }}
							</a>
						</div>
					</div>
		
				</ui-field>
			</template>
			
			<template #actions="{value}">
				<ui-form method="post" action="/api/emails-templates/test/" :value="{id:value.id}" #default="form" @success="modalTest=$event">
					<button type="button" class="btn btn-primary w-100" @click="form.submit()" v-loading="form.loading">
						Testar
					</button>
				</ui-form>
			</template>
		</ui-model-edit>

		<ui-modal v-model="modalTest">
			<template #header>Teste de e-mail recebido:</template>

			<template #body>
				<div class="border">
					<div class="p-2 border-bottom">
						Assunto: {{ modalTest.subject }}
					</div>
					<div class="p-2" v-html="modalTest.body"></div>
				</div>
			</template>

			<template #footer>
				<button type="button" class="btn btn-light" @click="modalTest=false">
					Ok
				</button>
			</template>
		</ui-modal>
	</div>
</template>

<script>
export default {
	head() {
		return {
			title: "Editar template de e-mail",
		};
	},
	
	data() {
		return {
			modalTest: false,
		};
	},
}
</script>