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


Artisan::command('app:mail-test', function () {
    $invite = \App\Models\TevepInvite::find(12);
    $mail = new \App\Mail\TevepInvite($invite);
    $mail->sendTo($mail->user->email);
})->describe('Teste de e-mail');