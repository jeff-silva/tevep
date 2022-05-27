<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppTableGenerate extends AppBase
{

    protected $signature = 'app:table-generate';
    protected $description = 'Instalação da aplicação';

    public function handle() {
        $table_name = $this->ask('Table name:');

        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        $this->comment("Table {$table_name} created");
    }
}
