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


Artisan::command('app:test', function() {

    // Notification
    // dd( \App\Models\User::find(1)->notify([
    //     'title' => 'Usuário',
    //     'body' => 'Este é um outro usuário',
    //     'image' => 'https://randomuser.me/api/portraits/men/65.jpg',
    // ]) );


    // Email
    // \Artisan::call('config:cache');
    // $mailers = env('MAIL_DRIVER');
    // $mailers = config("mail.mailers.{$mailers}");
    // $this->comment(json_encode($mailers));
    // $mail = \App\Models\Email::send('test@grr.la', 'E-mail de teste', '<h1>Isto é um e-mail de teste</h1>Lorem ipsum <strong>dolor sit amet</strong> consectetur adipisicing elit. Quas ea eos cumque aliquid distinctio amet,
    // <a href="https://google.com">esse obcaecati recusandae</a> exercitationem eligendi incidunt.
    // A <i>ipsam suscipit</i> ab odit dicta tempora ad dolor?');
    // $this->comment(json_encode($mail));
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