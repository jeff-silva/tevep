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


## Controllers

Todos os controllers são criados automaticamente no arquivo `/routes/api.php`.
Note que o arquivo apenas instancia os controllers com um aviso de "não edite":

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
new \App\Http\Controllers\PagesElementsController;
new \App\Http\Controllers\PlacesController;
new \App\Http\Controllers\SettingsController;
new \App\Http\Controllers\TevepsController;
new \App\Http\Controllers\TevepsInvitesController;
new \App\Http\Controllers\UsersController;
new \App\Http\Controllers\UsersGroupsController;

```

Supondo que o sistema terá um crud de produtos, vamos simular um controller customizado para esta tabela:

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
		 * 
		 * FooController        =>  /api/foo/ 
		 * FooBarController     =>  /api/foo-bar/ 
		 * FooBarBazController  =>  /api/foo-bar-baz/ 
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