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


## Models

Estas são todas as models disponíveis no sistema:
```php

App\Models\EmailsTemplates;
App\Models\Files;
App\Models\Pages;
App\Models\Settings;
App\Models\Teveps;
App\Models\TevepsInvites;
App\Models\Users;
App\Models\UsersGroups;

```


## Customizando models

Todas as models tem essa estrutura básica

```php
<?php

namespace App\Models;

// Nomes de model são sempre gerados no plural, igual as tabelas
class Products extends \Illuminate\Database\Eloquent\Model {

   // Muitas mágicas são geradas através dessa trait
   use \App\Traits\Model;
   
   // Nomes de tabelas sempre no plural
   protected $table = 'products';
   protected $fillable = ['id', 'slug', 'name', 'price', 'created_at', 'updated_at', 'deleted_at'];

   /*
    * Esse método é sempre executado antes de salvar/exibir dados
    * para forçar que valores sigam um determinado padrão.
    * Você ainda pode utilizar mutators normalmente, esse método
    * foi criado apenas para simplificar a vida.
    */
   public function modelMutator()
   {
       $this->price = $this->price? $this->price: 0;
   }

   /*
    * A trait Model faz com que os dados sejam sempre validados antes de salvar,
    * e caso algum erro seja encontrado, uma exceção é jogada. Isso garante consistência
    * ao que entra no banco impedindo que dados inválidos passem.
    * É nesse método que definimos as regras de validação do Laravel.
    * As regras são criadas dentro de um método para que você possa criar regras
    * condicionais, caso precise por exemplo, definir uma regra específica
    * quando o $this->id conter um valor.
    */
   public function validationRules()
   {
       return [
           'name' => ['required'],
       ];
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