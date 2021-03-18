<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar modulo básico para o sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $class = $this->ask('Informe o nome da classe (sem acentos, no singular. ex.: Exemplo)', 'Exemplo');
        $singular = $this->ask('Informe o nome do modulo (pode conter acentos, no SINGULAR ex.: Exemplo)', $class);
        $plural = $this->ask('Informe o nome do modulo (pode conter acentos, no PLURAL ex.: Exemplos)', $class.'s');
        $route = \Str::kebab($class);

$files[] = ['path'=>"app/Models/{$class}.php", 'content'=><<<EOF
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {$class} extends Model
{
    use \App\Traits\Model;

    protected \$fillable = [
        'id',
        'nome',
        'created_at',
        'updated_at',
    ];

    public function validate(\$data=[]) {
        return \Validator::make(\$data, [
            'nome' => ['required'],
        ]);
    }
}
EOF];


$files[] = ['path'=>"app/Http/Controllers/{$class}Controller.php", 'content'=><<<EOF
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class {$class}Controller extends Controller
{
    /**
     * Buscar {$plural}
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request \$request) {
        return (new \App\Models\\{$class})->search(\$request->all());
    }

    /**
     * Retornar {$singular} por id
     */
    public function find(\$id) {
        return \App\Models\\{$class}::find(\$id);
    }

    /**
     * Salvar dados de {$singular}
     */
    public function save(Request \$request) {
        return (new \App\Models\\{$class})->store(\$request->all());
    }

    /**
     * Deletar {$singular}
     */
    public function delete(\$id) {
        return \App\Models\\{$class}::find(\$id)->remove();
    }
}
EOF];


$files[] = ['path'=>"resources/nuxt/pages/admin/{$route}/index.vue", 'content'=><<<EOF
<template><div>
    <div class="input-group mb-3" style="max-width:300px;">
        <input type="text" class="form-control" v-model="searchParams.search" @keyup.enter="search{$class}()" placeholder="Buscar {$singular}" />
        <div class="input-group-append"><div class="input-group-btn">
            <button type="button" class="btn btn-primary" @click="search{$class}()">
                <i class="fa fa-fw fa-search"></i>
            </button>
        </div></div>
    </div>

    <ui-table v-bind.sync="search" :loading="loading">
        <template #empty>
            Nenhum(a) {$singular} foi encontrado(a).
        </template>

        <template #header>
            <th>Nome</th>
            <th>Últ. alteração</th>
        </template>

        <template #item="{item}">
            <td>{{ item.nome }}</td>
            <td><ui-timeago v-model="item.updated_at"></ui-timeago></td>
        </template>

        <template #actions="{item}">
            <nuxt-link :to="`/admin/{$route}/\${item.id}`" class="btn btn-primary">
                <i class="fa fa-fw fa-edit"></i>
            </nuxt-link>

            <a href="javascript:void(0);" class="btn btn-danger" @click="remove(item)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </template>
    </ui-table>

    <ui-flaction>
        <nuxt-link to="/admin/{$route}/0/" class="btn btn-primary">
            <i class="fa fa-fw fa-plus"></i>
        </nuxt-link>
    </ui-flaction>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            loading: false,
            searchParams: {
                search: '',
                orderby: 'updated_at',
                order: 'desc',
                page: 1,
            },
            search: {data:[]},
        };
    },

    methods: {
        search{$class}() {
            this.loading = true;
            this.\$axios.get('/api/{$route}/search', {params:this.searchParams}).then(resp => {
                this.search = resp.data;
                this.loading = false;
            });
        },

        remove(item) {
            this.\$swal({title: "Confirmação", html:`Deseja deletar \${item.nome}?`}).then((resp) => {
                if (! resp.value) return;
                this.\$axios.post(`/api/{$route}/delete/\${item.id}`).then(resp => {
                    this.search{$class}();
                });
            });
        },
    },

    mounted() {
        this.search{$class}();
    },
}
</script>
EOF];

$files[] = ['path'=>"resources/nuxt/pages/admin/{$route}/_id.vue", 'content'=><<<EOF
<template><div>
    <ui-form method="post" action="/api/{$route}/save/" v-model="edit" #default="{error, success, loading}" @success="success(\$event)">
        <ui-field label="Nome" :error="error.nome">
            <input type="text" class="form-control" v-model="edit.nome" />
        </ui-field>

        <ui-actions>
            <button type="submit" class="btn btn-primary">
                <span v-if="loading" v-html="loading"></span>
                <span v-else><i class="fas fa-save"></i> Salvar</span>
            </button>
        </ui-actions>
    </ui-form>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            edit: {},
        };
    },

    methods: {
        get{$class}() {
            this.loading = true;
            this.\$axios.get(`/api/{$route}/find/\${this.\$route.params.id}`).then(resp => {
                this.edit = resp.data||{};
                this.loading = false;
            });
        },

        success(resp) {
            this.\$swal('Sucesso', 'Dados salvos');
            this.\$router.push({path:`/admin/{$route}/\${resp.id}`});
        },
    },

    mounted() {
        if (!!this.\$route.params.id) {
            this.get{$class}();
        }
    },
}
</script>
EOF];

        foreach($files as $file) {
            $exists = file_exists(base_path($file['path']));
            
            $create_text = $exists? "O arquivo {$file['path']} já existe, deseja sobrescrever?": "Deseja criar o arquivo {$file['path']}?";
            if ($this->confirm($create_text, false)) {
                $file['path'] = base_path(str_replace('/', DIRECTORY_SEPARATOR, $file['path']));
                file_put_contents($file['path'], $file['content']);
                $this->comment("Arquivo {$file['path']} criado.");
            }
        }


        
        $this->comment("Insira as linhas abaixo em /routes/api.php:\n\n".implode("\n", [
            "Route::group(['middleware' => ['auth:api', 'permission']], function(\$router) {",
            "\t// {$plural}",
            "\tRoute::get('/{$route}/search', '\App\Http\Controllers\\{$class}Controller@search');",
            "\tRoute::get('/{$route}/find/{id}', '\App\Http\Controllers\\{$class}Controller@find');",
            "\tRoute::post('/{$route}/save', '\App\Http\Controllers\\{$class}Controller@save');",
            "\tRoute::post('/{$route}/delete/{id}', '\App\Http\Controllers\\{$class}Controller@delete');",
            "});",
        ]));

        $this->comment("Criacao do modulo {$plural} concluida.");
    }
}
