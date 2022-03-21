<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppDeploy extends AppBase
{

    protected $signature = 'app:deploy';
    protected $description = 'Deploy da aplicação';

    public function handle() {
        $this->call('app:install');
        include database_path('schema.php');
    }
}
