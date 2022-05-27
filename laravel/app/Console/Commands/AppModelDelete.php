<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppModelDelete extends AppBase
{

    protected $signature = 'app:model-delete {table_name : Table name to delete}';
    protected $description = 'Deletar tabela, model e controller';
    public $table_name = '';

    public function handle() {
        $this->table_name = $this->argument('table_name');
        if (!$this->table_name) return;
        $this->deleteTable();
        $this->deleteModel();
        $this->deleteController();
    }


    public function deleteTable()
    {
        if (! Schema::hasTable($this->table_name)) return;
        Schema::drop($this->table_name);
        $this->comment("Table {$this->table_name} deleted");
    }


    public function deleteModel()
    {
        $modelInfo = $this->getModel($this->table_name);
        if (! $modelInfo->FileExists) return;
        unlink(base_path($modelInfo->File));
        $this->comment("Model {$modelInfo->File} deleted");
    }


    public function deleteController()
    {
        $controllerInfo = $this->getController($this->table_name);
        if (! $controllerInfo->FileExists) return;
        unlink(base_path($controllerInfo->File));
        $this->comment("Controller {$controllerInfo->File} deleted");
    }
}
