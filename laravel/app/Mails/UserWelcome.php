<?php

namespace App\Mails;

class UserWelcome
{
    use \App\Traits\Mail;


    public function __construct(\App\Models\Users $user)
    {
        $this->setData(compact('user'));
    }


    static function getName()
    {
        return 'Boas vindas';
    }


    static function getSubject()
    {
        return 'Olá {{ $user->name }}';
    }


    static function getBody()
    {
        return [
            'Seja bem vindo(a). <br>',
            'Por favor, verifique seu e-mail',
            '<a href="{{ $user->getVerifyLink() }}">clicando aqui</a>.',
        ];
    }


    static function getParams() {
        return [
            '$user->name' => 'Nome do usuário',
            '$user->email' => 'E-mail do usuário',
            '$user->getVerifyLink()' => 'Link de verificação',
        ];
    }

    static function test()
    {
        $user = \App\Models\Users::inRandomOrder()->limit(1)->first();
        return new self($user);
    }
}