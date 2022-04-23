[Instalação](/docs/instalation.md) |
[Database](/docs/database.md) |
[Models](/docs/app-models.md) |
[Models search](/docs/app-models-search.md) |
[Models configurações](/docs/app-models-settings.md) |
[Controllers](/docs/app-http-controllers.md) |
[Permissões](/docs/config-permissions.md) |
[Envio de e-mails](/docs/app-mail.md) |
[Principais componentes Nuxt](/docs/client-components.md) |
[Schema](/docs/schema.md)

<hr>


## Permissões

As permissões são definidas em `/config/permissions.php` na chave `keys`.
Nesse local você precisa informar uma lista de arrays associativas `'name' => 'Descrição'`.
Name precisa ser obrigatoriamente o name da rota no backend ou o name do componente nuxt.
O usuário então só poderar executar uma rota ou acessar uma view nuxt se aquele name estiver
na sua lista de permissões.

Todas as rotas não públicas já são protegidas pelo middleware de segurança de permissão,
então para o backend você não precisa fazer nada para que a permissão funcione.
Já no frontend você precisa informar ao nuxt que aquela pagina será protegida pelo
middleware `permission`, que é basicamente fazer como mostra abaixo:

```html
<template>
   ... content ...
</template>

<script>
export default {
   middleware: ['permission'],
}
</script>
```