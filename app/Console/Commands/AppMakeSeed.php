<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar migration/seed baseado na estrutura do banco de dados';

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
        // $this->generateFiles();

        
        $_field = function($col, $last=false) {
            $field = ['$table'];
    
            if ($col->Field=='id') {
                $field[] = 'id()';
            }
    
            else if ($col->Field=='created_at') {
                $field[] = 'nullableTimestamps()';
            }

            else if ($col->Field=='updated_at') {
                return '/* Gerado pela função nullableTimestamps() dentro de created_at */';
            }

            else {
                if (preg_match('/int\((.+?)\)/', $col->Type, $match)) {
                    $field[] = "integer('{$col->Field}')";
                }
                else if (preg_match('/varchar\((.+?)\)/', $col->Type, $match)) {
                    $field[] = "string('{$col->Field}', {$match[1]})";
                }
                else if (preg_match('/text/', $col->Type, $match)) {
                    $field[] = "text('{$col->Field}')";
                }
                else if (preg_match('/decimal\(([0-9]+?),([0-9]+?)\)/', $col->Type, $match)) {
                    $field[] = "decimal('{$col->Field}', {$match[1]}, {$match[2]})";
                }
                else if (preg_match('/enum\((.+?)\)/', $col->Type, $match)) {
                    $field[] = "enum('{$col->Field}', [{$match[1]}])";
                }
                else {
                    $field[] = "text('{$col->Field}')";
                }
            }

            // if ($last) {
            //     $field[] = "after('{$last->Field}')";
            // }

            if ($col->Default) {
                $field[] = "default('{$col->Default}')";
            }
            
            if ($col->Comment) {
                $col->Comment = addslashes($col->Comment);
                $field[] = "comment('{$col->Comment}')";
            }

            if ($col->Null=='YES' AND $col->Field!='created_at' AND $col->Field!='updated_at') {
                $field[] = 'nullable()';
            }
    
            return implode('->', $field);
        };
    
        $file = [
            '<?php',
            '',
            'namespace Database\Seeders;',
            '',
            'use Illuminate\Database\Seeder;',
            'use Illuminate\Support\Facades\DB;',
            'use Illuminate\Support\Facades\Hash;',
            'use Illuminate\Support\Facades\Schema;',
            '',
            '/*',
            ' * Este arquivo é gerado automaticamente, Não edite-o diretamente.',
            ' * Para gerar este arquivo execute o comando "php artisan app:make-seed".',
            ' * O banco de dados contido aqui é criado ao executar o comando "php artisan app:deploy".',
            ' * Arquivo gerado pela última vez em '.date('d/m/Y à\s H:i:s'),
            '*/',
            '',
            'class AutoSeeder extends Seeder',
            '{',
            '',
            "\tpublic function run() {",
            '',
        ];
    
        $file[] = "\t\t\$schema = [";

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            if ($table->Comment) {
                $table->Comment = addslashes($table->Comment);
                $file[] = "\t\t\t/* {$table->Comment} */";
            }

            $file[] = "\t\t\t'{$table->Name}' => [";
            $file[] = "\t\t\t\t'comment' => '{$table->Comment}',";
            $file[] = "\t\t\t\t'fields' => [";
            
            $last = false;
            foreach(\DB::select("SHOW FULL COLUMNS FROM {$table->Name}") as $col) {
                if ($col->Comment) {
                    $file[] = "\t\t\t\t\t/* {$col->Field}: {$col->Comment} */";
                }
                $file[] = "\t\t\t\t\t'{$col->Field}' => function(\$table) { {$_field($col, $last)}; },";
                $last = $col;
            }
            $file[] = "\t\t\t\t],";

            $file[] = "\t\t\t],";
        }

        $file[] = "\t\t];";
        $file[] = '';
        $file[] = "\t\tforeach(\$schema as \$table_name=>\$table_data) {";
        $file[] = "\t\t\tif (\Schema::hasTable(\$table_name)) {";
        $file[] = "\t\t\t\t\Schema::table(\$table_name, function(\$table) use(\$table_name, \$table_data) {";
        $file[] = "\t\t\t\t\tforeach(\$table_data['fields'] as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tif (\Schema::hasColumn(\$table_name, \$column)) continue;";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t\t\DB::statement(\"ALTER TABLE `\$table_name` comment '{\$table_data['comment']}'\");";
        $file[] = "\t\t\t}";
        $file[] = "\t\t\telse {";
        $file[] = "\t\t\t\t\Schema::create(\$table_name, function(\$table) use(\$table_name, \$table_data) {";
        $file[] = "\t\t\t\t\tforeach(\$table_data['fields'] as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t\t\DB::statement(\"ALTER TABLE `\$table_name` comment '{\$table_data['comment']}'\");";
        $file[] = "\t\t\t}";
        $file[] = "\t\t}";
    
    
        $file[] = "\t}";
        $file[] = '}';
        $file[] = '';
        $file = implode("\n", $file);
        
        // $this->comment($file);
        $seeder_path = base_path(implode(DIRECTORY_SEPARATOR, ['database', 'seeders', 'AutoSeeder.php']));
        file_put_contents($seeder_path, $file);
    }



    public function bladeCompile($data=[], $html='') {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }


    public function generateFiles() {
        $schema = [];

        $schema['tables'] = [];
        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $table->FieldNames = [];
            $table->Fields = [];

            foreach(\DB::select("SHOW FULL COLUMNS FROM {$table->Name}") as $col) {
                $table->FieldNames[] = $col->Field;
                $table->Fields[ $col->Field ] = $col;
            }

            $table->Fields = (object) $table->Fields;
            $schema['tables'][ $table->Name ] = $table;
        }


        $files = [];
        foreach($schema['tables'] as $table_name=>$table) {
            $file = new \stdClass;
            $file->plural = $table_name;
            $file->singular = \Str::singular($table_name);

            $file->model = \Str::studly($file->singular);
            $file->modelName = "\App\Models\\{$file->model}";
            $file->modelFile = base_path("app/Models/{$file->model}.php");
            $file->modelExists = file_exists($file->modelFile);

            $file->modelAttributes = '{}';
            if ($file->modelExists) {
                $file->modelAttributes = json_encode((object) app($file->modelName));
            }

            $file->controller = "{$file->model}Controller";
            $file->controllerName = "\App\Http\Controllers\\{$file->controller}";
            $file->controllerFile = base_path("app/Http/Controllers/{$file->controller}.php");
            $file->controllerExists = file_exists($file->controllerFile);
            
            // $file->controllerMethods = array_filter(get_class_methods(app($file->controllerName)), function($method) {
            //     return ! in_array($method, [
            //         'middleware',
            //         'getMiddleware',
            //         'callAction',
            //         '__call',
            //         'authorize',
            //         'authorizeForUser',
            //         'authorizeResource',
            //         'dispatchNow',
            //         'validateWith',
            //         'validate',
            //         'validateWithBag',
            //     ]);
            // });


            $files[] = ['path' => "resources/nuxt/store/{$file->model}.js", 'content' => $this->bladeCompile((array) $file, '

export const state = () => ({
    model: {!! $modelAttributes !!},
    search: {
        search: "",
        page: 1,
        perpage: 10,
        orderby: "id",
        order: "desc",
    },
    result: {
        loading: false,
        current_page: 1,
        from: 1,
        per_page: 10,
        to: 1,
        total: 0,
        data: [],
    },
});

export const mutations = {
    set(state, tevep) {
        state.tevep = tevep;
    },
};

export const actions = {
    find(id) {
        this.$axios.get(`/api/{{ $singular }}/find/${id}`).then(resp => {
            // this.set(aa);
        });
    },

    search() {
        //
    },

    save({ dispatch }) {
        // await dispatch("aaa/bbb/ccc")
    },

    delete() {
        //
    },
};

')];


//             $files[] = ['path'=>"resources/nuxt/store/{$file->model}.js", 'content'=><<<EOF
// export const state = () => ({
//     model: {$file->modelAttributes},
//     searchParams: {
//         page: 1,
//         perpage: 10,
//         orderby: 'id',
//         order: 'desc',
//     },
//     search: {
//         loading: false,
//         data: [],
//     },
// });

// export const mutations = {
//     set(state, tevep) {
//         state.tevep = tevep;
//     },
// };

// export const actions = {
//     find() {
//         //
//     },

//     search() {
//         //
//     },

//     save({ dispatch }) {
//         await dispatch('core/load')
//     },

//     delete() {
//         //
//     },
// };
// EOF];
        }

        foreach($files as $file) {
            file_put_contents(base_path($file['path']), $file['content']);
        }

        dd($files);
    }
}
