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
    // $this->comment(Inspiring::quote());
    $this->comment(\App\Models\Email::send('jsiqueira@grr.la', 'Assunto', 'Corpo'));
    // dd( \App\Models\Setting::find('mail.mailers.smtp.host') );
    // dd( \App\Models\Setting::get() );
})->describe('Display an inspiring quote');
