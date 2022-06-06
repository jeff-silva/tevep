<?php

namespace App\Mails;

class TevepInvite
{
    use \App\Traits\Mail;


    public function __construct($invite_id)
    {
        $invite = \App\Models\TevepsInvites::find($invite_id);
        $tevep = \App\Models\Teveps::find($invite->tevep_id);
        $email = $invite->user_email;
        $user = \App\Models\Users::where('email', $invite->user_email)->first();
        $this->setData(compact('invite', 'tevep', 'email', 'user'));
    }

    
    static function getName()
    {
        return 'Convite Tevep';
    }


    static function getSubject()
    {
        return 'Olá {{ $user? $user->name: null }}';
    }


    static function getBody()
    {
        return [
            '<p>Você recebeu um convite para participar do evento <strong>{{ $tevep->name }}</strong>.</p>',
            '<p>Para poder participar, <a href="{{ $tevep->link() }}">clique aqui</a>.</p>',
        ];
    }


    static function getParams()
    {
        return [
            '$email' => 'E-mail contatado',
            '$tevep->name' => 'Nome do Tevep',
            '$tevep->link()' => 'Link do Tevep',
        ];
    }

    
    static function test()
    {
        $invite_id = \App\Models\TevepsInvites::select(['id'])->inRandomOrder()->limit(1)->value('id');
        return new self($invite_id);
    }
}