<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class LifeCycle extends AppBase
{

    protected $signature = 'life:cycle';
    protected $description = 'Ciclo de vida app';

    public function handle() {
        \App\Utils\Life::cycle();
    }
}
