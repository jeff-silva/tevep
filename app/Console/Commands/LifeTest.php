<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class LifeTest extends AppBase
{

    protected $signature = 'life:test';
    protected $description = 'Ciclo de vida teste';

    public function handle() {
        \App\Utils\Life::test();
    }
}
