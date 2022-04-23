[Instalação](/docs/instalation.md) <br>
[Database](/docs/database.md) <br>
[Models](/docs/app-models.md) <br>
[Models search](/docs/app-models-search.md) <br>
[Models configurações](/docs/app-models-settings.md) <br>
[Controllers](/docs/app-http-controllers.md) <br>
[Permissões](/docs/config-permissions.md) <br>
[Envio de e-mails](/docs/app-mail.md) <br>
[Principais componentes Nuxt](/docs/client-components.md) <br>
[Schema](/docs/schema.md) <br>


## Componentes mais importantes
```html
<!-- /client/components/ui-form.vue -->

<ui-form
 method="post"
 action="/api/products/save"
 v-model="product"
 #default="form"
>
 <!--
 Este componente apenas cria uma tag form com algumas funções a mais,
 portanto é possível trabalhar normalmente como em uma tag form
 como por exemplo, criando botões type=submit para envio do formulário
 e disparár o envio clicando enter em uma input.
 
 Parâmetros:
     method: get, post, etc... assim como no axios
     action: url do endpoint
     v-model: objeto que será enviado via post
     #default="form" variavel "form" com alguns dados internos do form como:
     form.loading: true ou false, informa se o form está em processamento
     form.response: dados da resposta, request.data do axios.
     form.error: mensagem de erro do form, em string
     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}
     form.submit: método submit() para envio do formulário
-->
</ui-form>
```

```html
<!-- /client/components/ui/model/edit.vue -->

<ui-model-edit
 model-name="products"
 model-id="153"
 singular="Produto"
 plural="Produtos"
 #default="form"
>
 <!--
 Este componente cria toda a interface básica para edição de dados,
 fazendo toda a parte repetitiva e deixando para você apenas a tarefa
 de informar quais os parâmetros básicos e como será o html dos campos.
 
 Parâmetros:
     model-name: Nome da model/table no formato kebab
     model-id: ID do registro (o sistema faz a requisição automaticamente para /products/find/153 e te retorna o objeto)
     singular: Nome no singular para descrições
     plural: Nome no plural para descrições
     #default="form" variavel "form" com alguns dados internos do form como:
     form.value: dados da model que serão editados/enviados via post
     form.loading: true ou false, informa se o form está em processamento
     form.error: mensagem de erro do form, em string
     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}
-->

 <!-- Insira os campos normalmente -->
 <ui-field label="Nome" :error="form.errorFields.owner">
     <input type="text" class="form-control" value="form.value.name" />
 </ui-field>

 <!-- Os botões na parte de baixo do formulário serão inseridos automaticamente, -->
 <!-- mas se você precisar customizar alguma ação, utilize esse slot: -->
 <slot name="actions">
     <button type="button" class="btn btn-success">
         Ação customizada 1
     </button>

     <button type="button" class="btn btn-success">
         Ação customizada 2
     </button>
 </slot>
</ui-model-edit>
```

```html
<!-- /client/components/ui/model/search.vue -->

<ui-model-search
>
</ui-model-search>
```

```html
<!-- /client/components/ui/model/select.vue -->

<ui-model-select
>
</ui-model-select>
```