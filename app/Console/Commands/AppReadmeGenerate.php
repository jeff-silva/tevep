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
        $tables = $this->getTables();
        
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
        foreach($tables as $table) {
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
            "   use \App\Traits\Model;",
            "   ",
            "   // Nomes de tabelas sempre no plural",
            "   protected \$table = 'products';",
            "   protected \$fillable = ['id', 'slug', 'name', 'price', 'created_at', 'updated_at', 'deleted_at'];",
            "",
            "   /*",
            "    * Esse método é sempre executado antes de salvar dados",
            "    * para forçar que valores sigam um determinado padrão.",
            "    * Você ainda pode utilizar mutators normalmente, esse método",
            "    * foi criado apenas para simplificar a vida.",
            "    */",
            "   public function toInput()",
            "   {",
            "       \$this->price = \$this->price? \$this->price: 0;",
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
        foreach($tables as $table) {
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
            "		 * Criando rotas automaticamente:",
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
            "		 * ExamplesController       =>  /api/examples/ ",
            "		 * ExamplesTestsController  =>  /api/examples-tests/ ",
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


        $file[] = '## Endpoints';
        $file[] = 'Todas as rotas disponíveis:';

        $table = [['Nº', 'METHODS', 'NAME', 'ROUTE']];
        foreach(\Route::getRoutes() as $index => $item) {
            if ($item->uri=='{path}') continue;
            if (\Str::startsWith($item->uri, '_ignition')) continue;
            if (\Str::startsWith($item->uri, 'sanctum')) continue;

            $methods = $item->methods();
            $search = array_search('HEAD', $methods);
            if ($search!==false) unset($methods[$search]);

            $table[] = [
                $index,
                implode(',', $methods),
                $item->getName(),
                $item->uri(),
            ];
        }

        $file[] = $this->makeTable($table);

        

        file_put_contents(base_path('README.md'), implode("\n", $file));
    }

    public function cmd($type, $code)
    {
        $code = is_array($code)? implode("\n", $code): $code;
        return "```{$type}\n{$code}\n```";
    }

    public function makeTable($items=[])
    {
        // $fieldSize = [];

        // foreach($items as $i => $row) {
        //     foreach($row as $ii => $value) {
        //         $fieldSize[$ii] = isset($fieldSize[$ii])? $fieldSize[$ii]: 0;
        //         $fieldSize[$ii] = max($fieldSize[$ii], strlen($value));
        //     }
        // }

        // $table[] = "```text\n";
        // foreach($items as $i => $row) {
        //     $table[] = '| ';
        //     foreach($row as $ii => $value) {
        //         $table[] = str_pad($value, $fieldSize[$ii], ' ');
        //         $table[] = ' | ';
        //     }
        //     $table[] = "\n";
        // }
        // $table[] = '```';

        // return implode('', $table);


        $content = '<table width="100%"><tbody>';
        foreach($items as $i => $row) {
            $content .= '<tr>';
            foreach($row as $ii => $value) {
                $content .= "<td>{$value}</td>";
            }
            $content .= '</tr>';
        }
        $content .= "</tbody></table>";

        return $content;
    }
}
