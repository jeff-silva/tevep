# Tevep
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

## Criando tabelas no banco
Criar tabelas na mão pode ser um pouco maçante, mesmo utilizando sua ferramente favorita para gerenciá-las.
Execute o comando abaixo para criar uma tabela básica, e a partir dela modelar conforme necessário:
```bash
php artisan app:table-generate
```
O comando irá lhe pedir um nome para a tabela, e a partir disso,
gerá-la com as colunas `id, slug, name, created_at, updated_at e deleted_at`.
Você pode renomear ou remover alguma dessas colunas caso necessário,
**embora seja fortemente sujerido que você as mantenha**, visto que
o sistema as usa para que você precise digitar o mínimo de código possível.

Não se esqueça de executar o comando abaixo assim que criar ou modificar uma tabela
para que o sistema gere ou customize as models, controllers e views para você
```bash
php artisan app:sync
```

## Models
Estas são todas as models disponíveis no sistema:
```php
App\Models\EmailsTemplates;
App\Models\Files;
App\Models\Pages;
App\Models\Settings;
App\Models\Teveps;
App\Models\TevepsInvites;
App\Models\User;
App\Models\UsersGroups;
```

## Customizando models
Todas as models tem essa estrutura básica
```php
<?php

namespace App\Models;

// Nomes de model são sempre gerados no plural, igual as tabelas
class Products extends \Illuminate\Database\Eloquent\Model {

   use \App\Traits\Model;
   
   // Nomes de tabelas sempre no plural
   protected $table = 'products';
   protected $fillable = ['id', 'slug', 'name', 'price', 'created_at', 'updated_at', 'deleted_at'];

   /*
    * Esse método é sempre executado antes de salvar dados
    * para forçar que valores sigam um determinado padrão.
    * Você ainda pode utilizar mutators normalmente, esse método
    * foi criado apenas para simplificar a vida.
    */
   public function toInput()
   {
       $this->price = $this->price? $this->price: 0;
   }

   /*
    * Todas as buscas são feitas pelo método ->search() da model,
    * e para que esse método funcione bem, precisamos informar a ele
    * quais são os parâmetros padrão para uma busca. Os parâmetros informados
    * aqui serão mergeados a outros parâmetros básicos, como q, page, perpage,
    * order, orderby e outros.
    */
   public function searchParams($params=[])
   {
       return [
           'price_min' => null
           'price_max' => null
       ];
   }

   /*
    * Como já explicado, todas as buscas são feitas pelo método ->search()
    * e aqui vamos customizar a $query de busca antes que ela seja entregue
    * para o ->search() executar. Trabalhar dessa forma é interessante porque
    * você vai reaproveitar muito mais concentrando toda a lógica de busca aqui
    * em vez de ficar copiando e colando linhas e mais linhas de queryBuilder
    * todas as vezes que precisar fazer uma busca nova.
    */
   public function searchQuery($query, $params)
   {
       if ($params->price_min) {
           $query->where('price', '>=', $params->price_min);
       }

       if ($params->price_max) {
           $query->where('price', '<=', $params->price_max);
       }
   }
}
```
Essa estrutura é gerada automaticamente quando você cria uma tabela.
A array `protected $fillable` também é alterada quando você cria/remove alguma
no banco e executa `php artisan app:sync`.
Você pode criar seus métodos, casts, mutators e o que mais for necessário
para sua model aqui normalmente. A única exigência das models são:
**NÃO REMOVA A TRAIT MODEL**. Ela é responsável por muitas coisas que vão te ajudar
a ter menos dor de cabeça para desenvolver.

## Busca
Sempre que você precisar buscar dados nos bancos, é aconselhável usar o
método `->search()` da model. Porque? Porquê é mais interessante concentrar
toda a lógica de busca em um método só, em vez de ficar duplicando linhas de
queryBuilder toda vez que precisar listar itens novamente.
```php
$query = $model->search();
```
Este método retorna um queryBuilder, então você já deve ter compreendido que
com esse valor que retorna, você pode executar um `->paginate()` para obter dados
paginados, um `->get()` para recuperar todos os itens possíveis ou um `->first()`
para obter apenas o primeiro registro.
```php
$item = $model->search()->first();
$items = $model->search()->get();
$data = $model->search()->paginate(15);
```
Você também pode concatenar outros métodos, mas se você quer ter um código
reaproveitável, talvez seja melhor criar um novo parmâmetro em `searchParams`
e programar a lógica desse parâmetro em `searchQuery`.
```php
// Funciona, mas você sempre vai ter que inserir esse where 🙄
$item = $model->search()->where('status', 'public')->get();

// Programando em searchParams e searchQuery fica mais reaproveitável 😎
$item = $model->search(['status' => 'public'])->get();
```

## Controllers
Estes são todos os controllers disponíveis no sistema:
```php
App\Http\Controllers\EmailsTemplatesController;
App\Http\Controllers\FilesController;
App\Http\Controllers\PagesController;
App\Http\Controllers\SettingsController;
App\Http\Controllers\TevepsController;
App\Http\Controllers\TevepsInvitesController;
App\Http\Controllers\UserController;
App\Http\Controllers\UsersGroupsController;
```

## Customizando controllers
Note que o arquivo `/routes/api.php` é bem limpo: tem apenas
alguns controllers sendo instanciados e um aviso de "não edite":
```php
<?php

/*
 * NÃO EDITE ESTE ARQUIVO: Ele é gerado automaticamente
 * Para sobrescrever este arquivo execute o comando "php artisan app:sync"
 * As rotas são criadas dentro dos controllers abaixo:
 */

new \App\Http\Controllers\AppController;
new \App\Http\Controllers\AuthController;
new \App\Http\Controllers\EmailsTemplatesController;
new \App\Http\Controllers\FilesController;
new \App\Http\Controllers\PagesController;
new \App\Http\Controllers\SettingsController;
new \App\Http\Controllers\TevepsController;
new \App\Http\Controllers\TevepsInvitesController;
new \App\Http\Controllers\UserController;
new \App\Http\Controllers\UsersGroupsController;

```
Este arquivo é gerado sempre que você executa `php artisan app:sync`,
por isso é uma má ideia editá-lo. Isso acontece porque as rotas
são definidas no próprio controller. As funções básicas estão comentadas:
```php
<?php

namespace App\Http\Controllers;

class ProductsController extends Controller
{
	public function __construct()
	{
		/*
		 * Referência para as rotas herdadas da classe Controller saberem
		 * com qual model estão trabalhando.
		 */
		$this->model = new \App\Models\Products;

		/*
		 * Aqui está sendo declarado que todas as rotas deste controller
		 * serão protegidas pelo middleware de autenticação,
		 * exceto as rotas search e find que serão públicas.
		 */
		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		/*
		 * Criando rotas automaticamente:
		 * Este método cria rotas básicas em comum para todos os controllers,
		 * como save, search, find, delete, clone e alguns outros.
		 * Note o argumento "except": ele define quais dessas rotas
		 * não devem ser criadas. O exemplo abaixo define que este controller
		 * não terá a rota /delete.
		 */
		$this->defaultRoutes([
		    'except' => ['delete'],
		]);

		/*
		 * Aqui você pode definir rotas customizadas.
		 * As rotas sempre serão criadas tomando como base o nome do controller
		 * convertido para kebab case sem o sufixo "Controller". Ou seja:
		 * ExamplesController       =>  /api/examples/ 
		 * ExamplesTestsController  =>  /api/examples-tests/ 
		 * 
		 * Conforme o exemplo dado, todas as rotas serão criadas
		 * dentro de /api/products.
		 * 
		 * parâmetro 1 = método (pode ser array ['get', 'post'] por exemplo)
		 * parâmetro 2 = rota
		 * parâmetro 3 = método do controller que será executado
		 */

		// POST: /api/products/{productId}/promo-add
		$this->route('post', '/{productId}/promo-add', 'promoAdd');

		// GET: /api/products/{productId}/promo-remove/{promoId}
		$this->route('get', '/{productId}/promo-remove/{promoId}', 'promoRemove');
	}

   public function promoAdd($productId)
   {
       return ['bla bla bla'];
   }

   public function promoRemove($productId, $promoId)
   {
       return ['bla bla bla'];
   }

}
```

## Configurações
As configurações são definidas na model \App\Models\Settings, no atributo $settingsKeys.
Lá é informado uma lista de configs que estão disponíveis para serem alteradas.

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

## Templates de e-mail
Crie uma classe de email em `app/Mail` seguindo as outras classes como exemplo.
Ao configurar todos os atributos, execute o comando `php artisan app:sync` e deixe
que o sistema se encarregue de popular este template de e-mail novo para o banco de dados.
Após isso, tudo o que você precisa fazer é clicar em editar o template pelo admin.

## Endpoints
Todas as rotas disponíveis:
```text
1   GET:    api/app/endpoints
2   GET:    api/app/dashboard
3   POST:   api/auth/login
4   POST:   api/auth/me
5   POST:   api/auth/logout
6   POST:   api/auth/refresh
7   POST:   api/auth/register
8   POST:   api/auth/password-reset-start
9   POST:   api/auth/password-reset-change
10  GET:    api/emails-templates/search
11  GET:    api/emails-templates/find/{id}
12  POST:   api/emails-templates/save
13  POST:   api/emails-templates/valid
14  POST:   api/emails-templates/import
15  GET:    api/emails-templates/export
16  POST:   api/emails-templates/test/{id}
17  GET:    api/files/search
18  GET:    api/files/find/{id}
19  POST:   api/files/save
20  POST:   api/files/valid
21  POST:   api/files/delete
22  POST:   api/files/restore
23  GET:    api/files/clone/{id}
24  POST:   api/files/import
25  GET:    api/files/export
26  GET:    api/files/view/{slug}.{ext}
27  GET:    api/pages/search
28  GET:    api/pages/find/{id}
29  POST:   api/pages/save
30  POST:   api/pages/valid
31  POST:   api/pages/delete
32  POST:   api/pages/restore
33  GET:    api/pages/clone/{id}
34  POST:   api/pages/import
35  GET:    api/pages/export
36  POST:   api/settings/import
37  GET:    api/settings/export
38  POST:   api/settings/save
39  GET:    api/settings/all
40  GET:    api/teveps/search
41  GET:    api/teveps/find/{id}
42  POST:   api/teveps/save
43  POST:   api/teveps/valid
44  POST:   api/teveps/delete
45  POST:   api/teveps/restore
46  GET:    api/teveps/clone/{id}
47  POST:   api/teveps/import
48  GET:    api/teveps/export
49  GET:    api/teveps-invites/search
50  GET:    api/teveps-invites/find/{id}
51  POST:   api/teveps-invites/save
52  POST:   api/teveps-invites/valid
53  POST:   api/teveps-invites/delete
54  POST:   api/teveps-invites/restore
55  GET:    api/teveps-invites/clone/{id}
56  POST:   api/teveps-invites/import
57  GET:    api/teveps-invites/export
58  GET:    api/user/search
59  GET:    api/user/find/{id}
60  POST:   api/user/save
61  POST:   api/user/valid
62  POST:   api/user/import
63  GET:    api/user/export
64  GET:    api/users-groups/search
65  GET:    api/users-groups/find/{id}
66  POST:   api/users-groups/save
67  POST:   api/users-groups/valid
68  POST:   api/users-groups/delete
69  POST:   api/users-groups/restore
70  GET:    api/users-groups/clone/{id}
71  POST:   api/users-groups/import
72  GET:    api/users-groups/export
73  GET:    api/users-groups/permissions
```