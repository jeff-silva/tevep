<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar/alterar controllers de acordo com modelo do banco';

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
     * @return mixed
     */
    public function handle()
    {
        // $this->comment('⚙️  Criando/alterando models');

        $api_generated = ['<?php'];

        $tables = config('database-schema.tables', []);
        foreach($tables as $table_name=>$table) {
            if (config("database-settings.controllers.{$table_name}")) {
                $slug = \Str::of($table_name)->singular()->studly()->kebab();

                $model = new \stdClass;

                $model->name = (string) \Str::of($table_name)->studly()->kebab();
                $model->name = array_map(['\Str', 'singular'], explode('-', $model->name));
                $model->name = (string) \Str::of(implode('-', $model->name))->studly();

                $model->namespace = "\App\Models\\{$model->name}";

                $controller = new \stdClass;

                $controller->name = (string) \Str::of($table_name)->studly()->kebab();
                $controller->name = array_map(['\Str', 'singular'], explode('-', $controller->name));
                $controller->name = (string) \Str::of(implode('-', $controller->name))->studly();
                $controller->name .= 'Controller';
                
                $controller->namespace = "\App\Http\Controllers\\{$controller->name}";
                $controller->file = app_path(implode(DIRECTORY_SEPARATOR, ['Http', 'Controllers', "{$controller->name}.php"]));
                $controller->file_exists = !!realpath($controller->file);

                if (! $controller->file_exists) {
                    file_put_contents($controller->file, implode("\n", [
                        '<?php',
                        '',
                        "namespace App\Http\Controllers;",
                        '',
                        "class {$controller->name} extends Controller",
                        '{',
                        '}',
                    ]));
                }

                $methods = [];

                $methods['getSearch'] = implode("\n", [
                    "\tpublic function getSearch() {",
                    "\t\treturn {$model->namespace}::querySearch();",
                    "\t}",
                ]);

                $methods['getFind'] = implode("\n", [
                    "\tpublic function getFind(\$id) {",
                    "\t\treturn {$model->namespace}::find(\$id);",
                    "\t}",
                ]);

                $methods['postSave'] = implode("\n", [
                    "\tpublic function postSave() {",
                    "\t\treturn (new {$model->namespace})->store(request()->all());",
                    "\t}",
                ]);

                $methods['postDelete'] = implode("\n", [
                    "\tpublic function postDelete(\$id) {",
                    "\t\treturn {$model->namespace}::find(\$id)->remove();",
                    "\t}",
                ]);

                foreach($methods as $method_name=>$method_content) {
                    $this->classWriteMethod($controller->namespace, $method_name, $method_content, $controller->file);
                }


                $api_generated[] = '';
                $prefix = (string) \Str::of($model->name)->kebab();
        
                foreach((new \ReflectionClass($controller->namespace))->getMethods() as $rmethod) {
                    $method_name = $rmethod->getName();
        
                    $ignore = ['getValidationFactory', 'getMiddleware'];
                    if (in_array($method_name, $ignore)) continue;
        
                    $methods = ['any', 'get', 'post', 'put', 'delete'];
                    foreach($methods as $method) {
                        if (\Str::startsWith($method_name, $method) AND $method_name!=$method) {
                            $method_path = (string) \Str::of(str_replace($methods, '', $method_name))->kebab();

                            $route = [$prefix, $method_path];
                            foreach($rmethod->getParameters() as $p) {
                                $route[] = "{{$p->name}}";
                            }
                            $route = implode('/', $route);
                            
                            $api_generated[] = "Route::{$method}('{$route}', '{$controller->namespace}@{$method_name}');";
                        }
                    }
                }
            }
        }


        $api_generated = implode("\n", $api_generated);
        $file = base_path(implode(DIRECTORY_SEPARATOR, ['routes', 'api-generated.php']));
        file_put_contents($file, $api_generated);
    }

    public function classWriteMethod($class, $method_name, $method_content, $filename) {
        if (is_string($class)) {
            $class = app($class);
        }

        $source = $this->classSource($class);

        if (method_exists($class, $method_name)) {
            // $source = preg_replace("/\t+public function {$method_name}(.+?)\}/s", $method_content, $source);
        }
        else {
            $source = rtrim(rtrim($source), '}') ."\n{$method_content}\n}";
        }

        file_put_contents($filename, $source);
    }

    public function classSource($class) {
        if (is_string($class)) {
            $class = app($this->Model->Namespace);
        }

        $class = new \ReflectionClass($class);
        $fileName = $class->getFileName();
        $startLine = $class->getStartLine()-1;
        $endLine = $class->getEndLine();
        $numLines = $endLine - $startLine;
        $fileContents = null;

        if(!empty($fileName)) {
            $fileContents = file_get_contents($fileName);
            $classSource = trim(implode('', array_slice(file($fileName), $startLine, $numLines))); // not perfect; if the class starts or ends on the same line as something else, this will be incorrect
            // $hash = crc32($classSource);
        }
        
        return $fileContents;
    }
}
