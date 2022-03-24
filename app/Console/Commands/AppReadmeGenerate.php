<?php

// TODO: Rotas definidas nos controllers
// TODO: api.php gerado automaticamente
// TODO: Melhoria nos componentes ui-file, ui-file-id e ui-file-select

namespace App\Console\Commands;

class AppReadmeGenerate extends AppBase
{

    protected $signature = 'app:readme-generate';
    protected $description = 'Gera documentação';

    public function handle() {
        $this->tables = $this->getTables();
        // $this->fks = $this->getFks();
        
        $file = [ '# '. env('APP_NAME') ];
        
        $file[] = '## Instalação';
        $file[] = 'Insira os dados do banco no arquivo `.env` e então execute';
        $file[] = 'os comandos abaixo, que respectivamente são para:';
        $file[] = '* Instalar dependências do laravel';
        $file[] = '* Criar tabelas, models, controllers, views e registros do banco';
        $file[] = '* Acessar pasta `/client`';
        $file[] = '* Instalar dependências javascript nesta pasta';

        $file[] = $this->cmd('bash', [
            'php composer install',
            'php artisan app:sync',
            'cd client',
            'npm install',
        ]);

        $file[] = '';

        $file[] = '## Desenvolvimento';
        $file[] = 'O comando abaixo executa backend+frontend juntos:';
        $file[] = $this->cmd('bash', 'npm run serve');
        $file[] = '';


        $file[] = '## Deploy';
        $file[] = 'O comando abaixo faz a build e prepara a aplicação para publicação';
        $file[] = $this->cmd('bash', 'npm run build');
        $file[] = '';


        $file[] = '## Criando tabelas no banco';
        $file[] = 'Criar tabelas na mão pode ser um pouco maçante, mesmo utilizando sua ferramente favorita para gerenciá-las.';
        $file[] = 'Execute o comando abaixo para criar uma tabela básica, e a partir dela modelar conforme necessário:';
        $file[] = $this->cmd('bash', 'php artisan app:table-generate');
        $file[] = 'O comando irá lhe pedir um nome para a tabela, e a partir disso,';
        $file[] = 'gerá-la com as colunas `id, slug, name, created_at, updated_at e deleted_at`.';
        $file[] = 'Você pode renomear ou remover alguma dessas colunas caso necessário,';
        $file[] = '**embora seja fortemente sujerido que você as mantenha**, visto que';
        $file[] = 'o sistema as usa para que você precise digitar o mínimo de código possível.';
        $file[] = '';
        $file[] = 'Não se esqueça de executar o comando abaixo assim que criar ou modificar uma tabela';
        $file[] = 'para que o sistema gere ou customize as models, controllers e views para você';
        $file[] = $this->cmd('bash', 'php artisan app:sync');
        $file[] = '';


        $file[] = '## Models';
        $file[] = 'Estas são todas as models disponíveis no sistema:';
        $file[] = '```php';
        foreach($this->tables as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            $file[] = "{$table->Model->NameFull};";
        }
        $file[] = '```';
        $file[] = '';


        $file[] = '## Customizando models';
        $file[] = 'Todas as models tem essa estrutura básica';
        $file[] = $this->cmd('php', [
            '<?php',
            '',
            'namespace App\Models;',
            '',
            '// Nomes de model são sempre gerados no plural, igual as tabelas',
            'class Products extends \Illuminate\Database\Eloquent\Model {',
            "",
            "   // Muitas mágicas são geradas através dessa trait",
            "   use \App\Traits\Model;",
            "   ",
            "   // Nomes de tabelas sempre no plural",
            "   protected \$table = 'products';",
            "   protected \$fillable = ['id', 'slug', 'name', 'price', 'created_at', 'updated_at', 'deleted_at'];",
            "",
            "   /*",
            "    * Esse método é sempre executado antes de salvar/exibir dados",
            "    * para forçar que valores sigam um determinado padrão.",
            "    * Você ainda pode utilizar mutators normalmente, esse método",
            "    * foi criado apenas para simplificar a vida.",
            "    */",
            "   public function modelMutator()",
            "   {",
            "       \$this->price = \$this->price? \$this->price: 0;",
            "   }",
            "",
            "   /*",
            "    * A trait Model faz com que os dados sejam sempre validados antes de salvar,",
            "    * e caso algum erro seja encontrado, uma exceção é jogada. Isso garante consistência",
            "    * ao que entra no banco impedindo que dados inválidos passem.",
            "    * É nesse método que definimos as regras de validação do Laravel.",
            "    * As regras são criadas dentro de um método para que você possa criar regras",
            "    * condicionais, caso precise por exemplo, definir uma regra específica",
            "    * quando o \$this->id conter um valor.",
            "    */",
            "   public function validationRules()",
            "   {",
            "       return [",
            "           'name' => ['required'],",
            "       ];",
            "   }",
            "",
            "   /*",
            "    * Todas as buscas são feitas pelo método ->search() da model,",
            "    * e para que esse método funcione bem, precisamos informar a ele",
            "    * quais são os parâmetros padrão para uma busca. Os parâmetros informados",
            "    * aqui serão mergeados a outros parâmetros básicos, como q, page, perpage,",
            "    * order, orderby e outros.",
            "    */",
            "   public function searchParams(\$params=[])",
            "   {",
            "       return [",
            "           'price_min' => null",
            "           'price_max' => null",
            "       ];",
            "   }",
            "",
            "   /*",
            "    * Como já explicado, todas as buscas são feitas pelo método ->search()",
            "    * e aqui vamos customizar a \$query de busca antes que ela seja entregue",
            "    * para o ->search() executar. Trabalhar dessa forma é interessante porque",
            "    * você vai reaproveitar muito mais concentrando toda a lógica de busca aqui",
            "    * em vez de ficar copiando e colando linhas e mais linhas de queryBuilder",
            "    * todas as vezes que precisar fazer uma busca nova.",
            "    */",
            "   public function searchQuery(\$query, \$params)",
            "   {",
            "       if (\$params->price_min) {",
            "           \$query->where('price', '>=', \$params->price_min);",
            "       }",
            "",
            "       if (\$params->price_max) {",
            "           \$query->where('price', '<=', \$params->price_max);",
            "       }",
            "   }",
            '}',
        ]);
        $file[] = 'Essa estrutura é gerada automaticamente quando você cria uma tabela.';
        $file[] = 'A array `protected $fillable` também é alterada quando você cria/remove alguma';
        $file[] = 'no banco e executa `php artisan app:sync`.';
        $file[] = 'Você pode criar seus métodos, casts, mutators e o que mais for necessário';
        $file[] = 'para sua model aqui normalmente. A única exigência das models são:';
        $file[] = '**NÃO REMOVA A TRAIT MODEL**. Ela é responsável por muitas coisas que vão te ajudar';
        $file[] = 'a ter menos dor de cabeça para desenvolver.';
        $file[] = '';


        $file[] = '## Busca';
        $file[] = 'Sempre que você precisar buscar dados nos bancos, é aconselhável usar o';
        $file[] = 'método `->search()` da model. Porque? Porquê é mais interessante concentrar';
        $file[] = 'toda a lógica de busca em um método só, em vez de ficar duplicando linhas de';
        $file[] = 'queryBuilder toda vez que precisar listar itens novamente.';
        $file[] = $this->cmd('php', '$query = $model->search();');
        $file[] = 'Este método retorna um queryBuilder, então você já deve ter compreendido que';
        $file[] = 'com esse valor que retorna, você pode executar um `->paginate()` para obter dados';
        $file[] = 'paginados, um `->get()` para recuperar todos os itens possíveis ou um `->first()`';
        $file[] = 'para obter apenas o primeiro registro.';
        $file[] = $this->cmd('php', [
            '$item = $model->search()->first();',
            '$items = $model->search()->get();',
            '$data = $model->search()->paginate(15);',
        ]);
        $file[] = 'Você também pode concatenar outros métodos, mas se você quer ter um código';
        $file[] = 'reaproveitável, talvez seja melhor criar um novo parmâmetro em `searchParams`';
        $file[] = 'e programar a lógica desse parâmetro em `searchQuery`.';
        $file[] = $this->cmd('php', [
            '// Funciona, mas você sempre vai ter que inserir esse where 🙄',
            '$item = $model->search()->where(\'status\', \'public\')->get();',
            '',
            '// Programando em searchParams e searchQuery fica mais reaproveitável 😎',
            '$item = $model->search([\'status\' => \'public\'])->get();',
        ]);
        $file[] = '';


        $file[] = '## Controllers';
        $file[] = 'Estes são todos os controllers disponíveis no sistema:';
        $file[] = '```php';
        foreach($this->tables as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            $file[] = "{$table->Controller->NameFull};";
        }
        $file[] = '```';
        $file[] = '';


        $file[] = '## Customizando controllers';
        $file[] = 'Note que o arquivo `/routes/api.php` é bem limpo: tem apenas';
        $file[] = 'alguns controllers sendo instanciados e um aviso de "não edite":';
        $file[] = $this->cmd('php', file_get_contents(base_path('routes/api.php')));
        $file[] = 'Este arquivo é gerado sempre que você executa `php artisan app:sync`,';
        $file[] = 'por isso é uma má ideia editá-lo. Isso acontece porque as rotas';
        $file[] = 'são definidas no próprio controller. As funções básicas estão comentadas:';
        $file[] = $this->cmd('php', [
            "<?php",
            "",
            "namespace App\Http\Controllers;",
            "",
            "class ProductsController extends Controller",
            "{",
            "	public function __construct()",
            "	{",
            "		/*",
            "		 * Referência para as rotas herdadas da classe Controller saberem",
            "		 * com qual model estão trabalhando.",
            "		 */",
            "		\$this->model = new \App\Models\Products;",
            "",
            "		/*",
            "		 * Aqui está sendo declarado que todas as rotas deste controller",
            "		 * serão protegidas pelo middleware de autenticação,",
            "		 * exceto as rotas search e find que serão públicas.",
            "		 */",
            "		\$this->middleware('auth:api', [",
            "			'except' => ['search', 'find'],",
            "		]);",
            "",
            "		/*",
            "		 * Este método cria rotas básicas em comum para todos os controllers,",
            "		 * como save, search, find, delete, clone e alguns outros.",
            "		 * Note o argumento \"except\": ele define quais dessas rotas",
            "		 * não devem ser criadas. O exemplo abaixo define que este controller",
            "		 * não terá a rota /delete.",
            "		 */",
            "		\$this->defaultRoutes([",
            "		    'except' => ['delete'],",
            "		]);",
            "",
            "		/*",
            "		 * Aqui você pode definir rotas customizadas.",
            "		 * As rotas sempre serão criadas tomando como base o nome do controller",
            "		 * convertido para kebab case sem o sufixo \"Controller\". Ou seja:",
            "		 * ",
            "		 * FooController        =>  /api/foo/ ",
            "		 * FooBarController     =>  /api/foo-bar/ ",
            "		 * FooBarBazController  =>  /api/foo-bar-baz/ ",
            "		 * ",
            "		 * Conforme o exemplo dado, todas as rotas serão criadas",
            "		 * dentro de /api/products.",
            "		 * ",
            "		 * parâmetro 1 = método (pode ser array ['get', 'post'] por exemplo)",
            "		 * parâmetro 2 = rota",
            "		 * parâmetro 3 = método do controller que será executado",
            "		 */",
            "",
            "		// POST: /api/products/{productId}/promo-add",
            "		\$this->route('post', '/{productId}/promo-add', 'promoAdd');",
            "",
            "		// GET: /api/products/{productId}/promo-remove/{promoId}",
            "		\$this->route('get', '/{productId}/promo-remove/{promoId}', 'promoRemove');",
            "	}",
            "",
            "   public function promoAdd(\$productId)",
            "   {",
            "       return ['bla bla bla'];",
            "   }",
            "",
            "   public function promoRemove(\$productId, \$promoId)",
            "   {",
            "       return ['bla bla bla'];",
            "   }",
            "",
            "}",
        ]);
        $file[] = '';


        $file[] = '## Configurações';
        $file[] = 'As configurações são definidas na model \App\Models\Settings, no atributo $settingsKeys.';
        $file[] = 'Lá é informado uma lista de configs que estão disponíveis para serem alteradas.';
        $file[] = '';


        $file[] = '## Permissões';
        $file[] = 'As permissões são definidas em `/config/permissions.php` na chave `keys`.';
        $file[] = 'Nesse local você precisa informar uma lista de arrays associativas `\'name\' => \'Descrição\'`.';
        $file[] = 'Name precisa ser obrigatoriamente o name da rota no backend ou o name do componente nuxt.';
        $file[] = 'O usuário então só poderar executar uma rota ou acessar uma view nuxt se aquele name estiver';
        $file[] = 'na sua lista de permissões.';
        $file[] = '';
        $file[] = 'Todas as rotas não públicas já são protegidas pelo middleware de segurança de permissão,';
        $file[] = 'então para o backend você não precisa fazer nada para que a permissão funcione.';
        $file[] = 'Já no frontend você precisa informar ao nuxt que aquela pagina será protegida pelo';
        $file[] = 'middleware `permission`, que é basicamente fazer como mostra abaixo:';
        $file[] = $this->cmd('html', [
            "<template>",
            "   ... content ...",
            "</template>",
            "",
            "<script>",
            "export default {",
            "   middleware: ['permission'],",
            "}",
            "</script>",
        ]);
        $file[] = '';
        
        
        $file[] = '## Templates de e-mail';
        $file[] = 'Crie uma classe de email em `app/Mail` seguindo as outras classes como exemplo.';
        $file[] = 'Ao configurar todos os atributos, execute o comando `php artisan app:sync` e deixe';
        $file[] = 'que o sistema se encarregue de popular este template de e-mail novo para o banco de dados.';
        $file[] = 'Após isso, tudo o que você precisa fazer é clicar em editar o template pelo admin.';
        $file[] = '';


        $file[] = '## Layouts frontend';
        $file[] = '## ';
        
        
        $file[] = '## Componentes mais importantes';

        $file[] = '```html';
        $file[] = '<!-- /client/components/ui-form.vue -->';
        $file[] = '';
        $file[] = '<ui-form';
        $file[] = ' method="post"';
        $file[] = ' action="/api/products/save"';
        $file[] = ' v-model="product"';
        $file[] = ' #default="form"';
        $file[] = '>';
        $file[] = ' <!--';
        $file[] = ' Este componente apenas cria uma tag form com algumas funções a mais,';
        $file[] = ' portanto é possível trabalhar normalmente como em uma tag form';
        $file[] = ' como por exemplo, criando botões type=submit para envio do formulário';
        $file[] = ' e disparár o envio clicando enter em uma input.';
        $file[] = ' ';
        $file[] = ' Parâmetros:';
        $file[] = '     method: get, post, etc... assim como no axios';
        $file[] = '     action: url do endpoint';
        $file[] = '     v-model: objeto que será enviado via post';
        $file[] = '     #default="form" variavel "form" com alguns dados internos do form como:';
        $file[] = '     form.loading: true ou false, informa se o form está em processamento';
        $file[] = '     form.response: dados da resposta, request.data do axios.';
        $file[] = '     form.error: mensagem de erro do form, em string';
        $file[] = '     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}';
        $file[] = '     form.submit: método submit() para envio do formulário';
        $file[] = '-->';
        $file[] = '</ui-form>';
        $file[] = '```';
        $file[] = '';


        $file[] = '```html';
        $file[] = '<!-- /client/components/ui/model/edit.vue -->';
        $file[] = '';
        $file[] = '<ui-model-edit';
        $file[] = ' model-name="products"';
        $file[] = ' model-id="153"';
        $file[] = ' singular="Produto"';
        $file[] = ' plural="Produtos"';
        $file[] = ' #default="form"';
        $file[] = '>';
        $file[] = ' <!--';
        $file[] = ' Este componente cria toda a interface básica para edição de dados,';
        $file[] = ' fazendo toda a parte repetitiva e deixando para você apenas a tarefa';
        $file[] = ' de informar quais os parâmetros básicos e como será o html dos campos.';
        $file[] = ' ';
        $file[] = ' Parâmetros:';
        $file[] = '     model-name: Nome da model/table no formato kebab';
        $file[] = '     model-id: ID do registro (o sistema faz a requisição automaticamente para /products/find/153 e te retorna o objeto)';
        $file[] = '     singular: Nome no singular para descrições';
        $file[] = '     plural: Nome no plural para descrições';
        $file[] = '     #default="form" variavel "form" com alguns dados internos do form como:';
        $file[] = '     form.value: dados da model que serão editados/enviados via post';
        $file[] = '     form.loading: true ou false, informa se o form está em processamento';
        $file[] = '     form.error: mensagem de erro do form, em string';
        $file[] = '     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}';
        $file[] = '-->';
        $file[] = '';
        $file[] = ' <!-- Insira os campos normalmente -->';
        $file[] = ' <ui-field label="Nome" :error="form.errorFields.owner">';
        $file[] = '     <input type="text" class="form-control" value="form.value.name" />';
        $file[] = ' </ui-field>';
        $file[] = '';
        $file[] = ' <!-- Os botões na parte de baixo do formulário serão inseridos automaticamente, -->';
        $file[] = ' <!-- mas se você precisar customizar alguma ação, utilize esse slot: -->';
        $file[] = ' <slot name="actions">';
        $file[] = '     <button type="button" class="btn btn-success">';
        $file[] = '         Ação customizada 1';
        $file[] = '     </button>';
        $file[] = '';
        $file[] = '     <button type="button" class="btn btn-success">';
        $file[] = '         Ação customizada 2';
        $file[] = '     </button>';
        $file[] = ' </slot>';
        $file[] = '</ui-model-edit>';
        $file[] = '```';
        $file[] = '';


        $file[] = '```html';
        $file[] = '<!-- /client/components/ui/model/search.vue -->';
        $file[] = '';
        $file[] = '<ui-model-search';
        // $file[] = ' method="post"';
        // $file[] = ' action="/api/products/save"';
        // $file[] = ' v-model="product"';
        // $file[] = ' #default="form"';
        $file[] = '>';
        // $file[] = ' <!--';
        // $file[] = ' esse componente apenas cria uma tag form com algumas funções a mais,';
        // $file[] = ' portanto é possível trabalhar normalmente como em uma tag form';
        // $file[] = ' como por exemplo, criando botões type=submit para envio do formulário';
        // $file[] = ' e disparár o envio clicando enter em uma input.';
        // $file[] = ' ';
        // $file[] = ' Parâmetros:';
        // $file[] = '     method: get, post, etc... assim como no axios';
        // $file[] = '     action: url do endpoint';
        // $file[] = '     v-model: objeto que será enviado via post';
        // $file[] = '     #default="form" variavel "form" com alguns dados internos do form como:';
        // $file[] = '     form.loading: true ou false, informa se o form está em processamento';
        // $file[] = '     form.response: dados da resposta, request.data do axios.';
        // $file[] = '     form.error: mensagem de erro do form, em string';
        // $file[] = '     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}';
        // $file[] = '     form.submit: método submit() para envio do formulário';
        // $file[] = '-->';
        $file[] = '</ui-model-search>';
        $file[] = '```';
        $file[] = '';


        $file[] = '```html';
        $file[] = '<!-- /client/components/ui/model/select.vue -->';
        $file[] = '';
        $file[] = '<ui-model-select';
        // $file[] = ' method="post"';
        // $file[] = ' action="/api/products/save"';
        // $file[] = ' v-model="product"';
        // $file[] = ' #default="form"';
        $file[] = '>';
        // $file[] = ' <!--';
        // $file[] = ' esse componente apenas cria uma tag form com algumas funções a mais,';
        // $file[] = ' portanto é possível trabalhar normalmente como em uma tag form';
        // $file[] = ' como por exemplo, criando botões type=submit para envio do formulário';
        // $file[] = ' e disparár o envio clicando enter em uma input.';
        // $file[] = ' ';
        // $file[] = ' Parâmetros:';
        // $file[] = '     method: get, post, etc... assim como no axios';
        // $file[] = '     action: url do endpoint';
        // $file[] = '     v-model: objeto que será enviado via post';
        // $file[] = '     #default="form" variavel "form" com alguns dados internos do form como:';
        // $file[] = '     form.loading: true ou false, informa se o form está em processamento';
        // $file[] = '     form.response: dados da resposta, request.data do axios.';
        // $file[] = '     form.error: mensagem de erro do form, em string';
        // $file[] = '     form.errorFields: objeto javascript com erros de validação, no formato {campo:["erro1", "erro2"]}';
        // $file[] = '     form.submit: método submit() para envio do formulário';
        // $file[] = '-->';
        $file[] = '</ui-model-select>';
        $file[] = '```';
        $file[] = '';
        
        
        $file[] = '## Estrutura do banco';
        $file[] = '<img src="database/schema.svg" alt="" width="100%" height="auto">';
        $file[] = '';


        $file[] = '## Endpoints';
        $file[] = 'Todas as rotas disponíveis:';

        $content = '<table><tbody>';
        $content .= '<tr><td>Nº</td><td>Methods</td><td>Route</td><td>Name</td><td>Public</td></tr>';
        foreach($this->getTables() as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            foreach(app($table->Controller->NameFull)->getGeneratedRoutes() as $index => $route) {
                $content .= '<tr>';
                $content .= "<td>{$index}</td>";
                $content .= '<td>'. implode(', ', $route->methods) .'</td>';
                $content .= "<td>/api/{$route->path}</td>";
                $content .= "<td>{$route->name}</td>";
                $content .= '<td>'. ($route->is_public? 'ok': '') .'</td>';
                $content .= '</tr>';
            }
        }
        $content .= '</tbody></table>';

        $file[] = $content;
        $file[] = '';
        
        file_put_contents(base_path('README.md'), implode("\n", $file));
    }

    public function cmd($type, $code)
    {
        $code = is_array($code)? implode("\n", $code): $code;
        return "```{$type}\n{$code}\n```";
    }
}
