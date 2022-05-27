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