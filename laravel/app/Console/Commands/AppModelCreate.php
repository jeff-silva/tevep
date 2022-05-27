<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppModelCreate extends AppBase
{

    protected $signature = 'app:model-create {table_name : Table name to create}';
    protected $description = 'Criar tabela, model e controller';
    public $table_name = '';
    public $table_fields = [
        'id' => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
        'slug' => 'VARCHAR(255) NULL DEFAULT NULL',
        'name' => 'VARCHAR(255) NULL DEFAULT NULL',
        'created_at' => 'DATETIME NULL DEFAULT NULL',
        'updated_at' => 'DATETIME NULL DEFAULT NULL',
        'deleted_at' => 'DATETIME NULL DEFAULT NULL',
    ];

    public function handle() {
        $this->table_name = $this->argument('table_name');
        if (!$this->table_name) return;
        $this->createTable();
        $this->createModel();
        $this->createController();
    }


    public function createTable()
    {
        if (Schema::hasTable($this->table_name)) return;

        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        $this->comment("Table {$this->table_name} created");
    }


    public function createModel()
    {
        $modelInfo = $this->getModel($this->table_name);
        if ($modelInfo->FileExists) return;
        
        $file = new \Nette\PhpGenerator\PhpFile();
        
        $class = $file->addClass($modelInfo->NameFull);
        $class->setExtends('\Illuminate\Database\Eloquent\Model');
        $class->addTrait('\Illuminate\Database\Eloquent\Factories\HasFactory');
        $class->addTrait('\App\Traits\Model');

        $class->addProperty('singular')->setProtected()
            ->setValue((string) \Str::of($this->table_name)->singular());

        $class->addProperty('plural')->setProtected()
            ->setValue((string) \Str::of($this->table_name)->plural());

        $class->addProperty('table')->setProtected()
            ->setValue($this->table_name);

        $class->addProperty('fillable')->setProtected()
            ->setValue(array_keys($this->table_fields));

        $class->addMethod('schemaFields')->setPublic()
            ->setBody('return '. $this->varExport($this->table_fields) .';');

        $class->addMethod('mutatorSave')->setPublic()
            ->addComment('Change $this attributes before save')
            ->setBody('// $this->name = ucfirst($this->name);');

        $class->addMethod('mutatorRetrieve')->setPublic()
            ->addComment('Change $this attributes before retrieve')
            ->setBody('// $this->name = ucfirst($this->name);');

        file_put_contents(base_path($modelInfo->File), $file->__toString());
        $this->comment("Model {$modelInfo->File} created");
    }


    public function createController()
    {
        $controllerInfo = $this->getController($this->table_name);
        if ($controllerInfo->FileExists) return;

        $modelInfo = $this->getModel($this->table_name);
        $file = new \Nette\PhpGenerator\PhpFile();
        $file->addNamespace('App\Http\Controllers');

        $class = $file->addClass($controllerInfo->NameFull);
        $class->setExtends('\App\Http\Controllers\Controller');

        $class->addMethod('__construct')->setPublic()
            ->setBody(implode("\n", [
                "\$this->model = new \\{$modelInfo->NameFull};",
                '',
                "\$this->middleware('auth:api', [",
                "\t'except' => [],",
                "]);",
                '',
                '$this->defaultRoutes([\'except\' => []]);',
                '',
                "// get: /api/{$controllerInfo->Slug}/example => {$controllerInfo->Name}@example",
                "// \$this->route('get', '/example', 'example');",
            ]));

        file_put_contents(base_path($controllerInfo->File), $file->__toString());
        $this->comment("Controller {$controllerInfo->File} created");
    }
}
