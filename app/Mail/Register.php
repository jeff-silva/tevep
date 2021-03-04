<?php

namespace App\Mail;


class Register extends \App\Mail\Model
{
    public $subject = 'Olá {{ $user->name }}';

    public $body = 'Seja bem vindo.
Por favor, verifique seu e-mail <a href="{{ $user->verificationLink() }}">clicando aqui</a>.';
}