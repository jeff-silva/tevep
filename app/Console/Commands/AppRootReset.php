<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

use OpenApi\Serializer;

class AppSync extends AppBase
{

    protected $signature = 'app:root-reset';
    protected $description = 'Reset user root';

    public function handle() {
        $password = '321321';
        $user = \App\Models\Users::firstOrNew(['id' => 1]);
        $user->name = 'Root User';
        $user->email = 'root@grr.la';
        $user->password = \Hash::make($password);
        $user->group_id = 1;
        $user->save();
        $this->info("Password: {$password}");
    }
}
