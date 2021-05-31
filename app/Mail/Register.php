<?php

namespace App\Mail;

class Register extends \Illuminate\Mail\Mailable
{
    use \App\Traits\Mail;

    public $user = false;
    public $verify_link = false;

    public function __construct(\App\Models\User $user) {
        $this->user = $user;
        $this->verify_link = url('/user/verify/'. base64_encode(serialize($user)));
    }

    static function getSubject() {
        return 'Olá {{ $user->name }}';
    }

    static function getBody() {
        return 'Seja bem vindo. Por favor, verifique seu e-mail
        <a href="{{ $verify_link }}">clicando aqui</a>.';
    }
}