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

        $tables = config('database-schema.tables', []);
        foreach($tables as $table_name=>$table) {
            if (config("database-settings.models.{$table_name}")) {
                $model = new \stdClass;
                $model->name = (string) \Str::of($table_name)->studly()->singular();
                $model->namespace = "\App\Models\\{$model->name}";

                $controller = new \stdClass;
                $controller->name = (string) \Str::of($table_name)->studly()->singular() .'Controller';
                $controller->namespace = "\App\Http\Controllers\\{$controller->name}";
                $controller->file = app_path(implode(DIRECTORY_SEPARATOR, ['Http', 'Controllers', "{$controller->name}.php"]));
                $controller->file_exists = !!realpath($controller->file);

                $methods = [];

                $methods['search'] = implode("\n", [
                    "\tpublic function search(Request \$request) {",
                    "\t\treturn (new {$model->namespace})->search(\$request->all());",
                    "\t}",
                ]);

                $methods['find'] = implode("\n", [
                    "\tpublic function find(\$id) {",
                    "\t\treturn {$model->namespace}::find(\$id);",
                    "\t}",
                ]);

                $methods['save'] = implode("\n", [
                    "\tpublic function save(Request \$request) {",
                    "\t\treturn (new {$model->namespace})->store(\$request->all());",
                    "\t}",
                ]);

                $methods['delete'] = implode("\n", [
                    "\tpublic function delete(\$id) {",
                    "\t\treturn {$model->namespace}::find(\$id)->remove();",
                    "\t}",
                ]);

                foreach($methods as $method_name=>$method_content) {
                    $this->classWriteMethod($controller->namespace, $method_name, $method_content, $controller->file);
                }
            }
        }
    }

    public function classWriteMethod($class, $method_name, $method_content, $filename) {
        if (is_string($class)) {
            $class = app($class);
        }

        $source = $this->classSource($class);

        if (method_exists($class, $method_name)) {
            $source = preg_replace("/\t+public function {$method_name}(.+?)\}/s", $method_content, $source);
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
