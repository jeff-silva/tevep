<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

use OpenApi\Serializer;

class AppSync extends AppBase
{

    protected $signature = 'app:sync';
    protected $description = 'Synchronize database, models and controllers';

    public function handle() {
        $this->call('app:permissions');
        $this->call('app:models-generate');
        $this->call('app:controllers-generate');
        $this->call('app:routes-generate');
        $this->call('app:db-schema');
        $this->call('app:nuxt-views-generate');
        $this->call('app:parent-sync');
        $this->call('app:seed');
        $this->call('app:readme-generate');
        $this->call('app:swagger');
    }
}
