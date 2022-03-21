<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppRoutesGenerate extends AppBase
{

    protected $signature = 'app:routes-generate';
    protected $description = 'Gera arquivo de rotas';

    public function handle() {

        $file = ['<?php', ''];

        $file[] = '/*';
        $file[] = ' * NÃO EDITE ESTE ARQUIVO: Ele é gerado automaticamente';
        $file[] = ' * Para sobrescrever este arquivo execute o comando "php artisan app:sync"';
        $file[] = ' * As rotas são criadas dentro de seus respectivos controllers';
        $file[] = ' */';
        $file[] = '';
        
        $file[] = 'new \App\Http\Controllers\AppController;';
        $file[] = 'new \App\Http\Controllers\AuthController;';

        foreach($this->getTables() as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            $file[] = "new \\{$table->Controller->NameFull};";
        }

        $file[] = '';

        file_put_contents(realpath(base_path('routes/api.php')), implode("\n", $file));
    }
}
