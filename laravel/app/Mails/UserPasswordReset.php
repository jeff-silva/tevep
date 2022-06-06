<?php

namespace App\Mails;

class UserPasswordReset
{
    use \App\Traits\Mail;


    public function __construct(\App\Models\Users $user)
    {
        $this->setData(compact('user'));
    }


    static function getName()
    {
        return 'Alteração de senha';
    }


    static function getSubject()
    {
        return 'Alteração de senha';
    }


    static function getBody()
    {
        return [
            'Uma requisição para alterar senha foi gerada. <br>',
            'Caso não tenha sido você, ignore este e-mail. <br><br>',
            'Seu código para alteração de senha é: <br>',
            '<div style="white-space: pre; letter-spacing: 3px; background: #eee; padding: 10px; display: block;">{{ $user->remember_token? $user->remember_token: "TESTE" }}</div>',
        ];
    }

    
    static function getParams() {
        return [
            '$user->name' => 'Nome do usuário',
            '$user->email' => 'E-mail do usuário',
            '$user->remember_token' => 'Token',
        ];
    }

    static function test()
    {
        $user = \App\Models\Users::inRandomOrder()->limit(1)->first();
        return new self($user);
    }
}