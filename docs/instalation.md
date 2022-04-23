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


## Instalação

Insira os dados do banco no arquivo `.env` e então execute
os comandos abaixo, que respectivamente são para:
* Instalar dependências do laravel
* Criar tabelas, models, controllers, views e registros do banco
* Acessar pasta `/client`
* Instalar dependências javascript nesta pasta

```bash
php composer install
php artisan app:sync
cd client
npm install
```


## Desenvolvimento

O comando abaixo executa backend+frontend juntos:
```bash
npm run serve
```


## Deploy

O comando abaixo faz a build e prepara a aplicação para publicação
```bash
npm run build
```