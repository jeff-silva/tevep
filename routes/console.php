<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('app-mail', function() {
    $mail = \App\Utils::mail([
        'to' => 'test@grr.la',
        'subject' => 'E-mail de teste',
        'body' => 'Lorem ipsum <strong>dolor sit amet</strong> consectetur adipisicing elit. Quas ea eos cumque aliquid distinctio amet,
        <a href="https://google.com">esse obcaecati recusandae</a> exercitationem eligendi incidunt.
        A <i>ipsam suscipit</i> ab odit dicta tempora ad dolor?',
    ]);

    $this->comment(json_encode($mail));
});


Artisan::command('app-deploy', function () {
    $separator = '-------------------------------------------------';
    $this->comment($separator);
    $this->comment('Deploy start');

    $database_file = database_path('database.sqlite');
    if (! file_exists($database_file)) { file_put_contents($database_file, ''); }

    \Artisan::call('migrate');
    \Artisan::call('db:seed');

    include \App\Utils::path(base_path('/app/install.php'));
    foreach(\App\Providers\AppServiceProvider::modules() as $module) {
        if ($module->install) {
            $this->comment($separator);
            $this->comment("Configuring {$module->namespace}");
            $this->comment("Path: {$module->install}");
            include $module->install;
        }
    }

    $this->comment($separator);
    $this->comment('Clearing caches');
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('optimize:clear');
    
    $this->comment('Finish');
    $this->comment($separator);
})->describe('App deploy');