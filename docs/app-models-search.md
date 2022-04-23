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