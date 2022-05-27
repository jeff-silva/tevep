<?php

namespace App\Console\Commands;

class AppControllersGenerate extends AppBase
{

    protected $signature = 'app:controllers-generate';
    protected $description = 'Generate controllers based on database tables';

    public function handle() {
        foreach($this->getTables() as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            
            if (! $table->Controller->FileExists) {
                $file = new \Nette\PhpGenerator\PhpFile();
                $class = $file->addClass($table->Controller->NameFull);
                $class->setExtends("{$table->Controller->Namespace}\Controller");

                $method = $class->addMethod('__construct');
                $method->setBody(implode("\n", [
                    "\$this->model = new \\{$table->Model->NameFull};",
                    '',
                    "\$this->middleware('auth:api', [",
                    "\t'except' => ['search', 'find'],",
                    "]);",
                    '',
                    '// Generate default routes (search, find, save, delete, etc...)',
                    "\$this->defaultRoutes();",
                    '',
                    "// Custom route example: POST /api/{$table->Slug}/test/123",
                    "// \$this->route('post', '/test/{id}', '@test');",
                ]));

                file_put_contents(base_path($table->Controller->File), $file->__toString());
            }
        }
    }
}
