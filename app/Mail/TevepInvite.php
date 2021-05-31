<?php

namespace App\Mail;

class TevepInvite extends \Illuminate\Mail\Mailable
{
    use \App\Traits\Mail;
    
    public $user = false;
    public $invite = false;
    public $tevep = false;
    public $tevepLink = false;

    public function __construct(\App\Models\TevepInvite $invite) {
        $this->invite = $invite;

        if ($tevep = \App\Models\Tevep::find($invite->tevep_id)) {
            $this->tevep = $tevep;
            $this->tevepLink = url("/admin/tevep/{$tevep->id}");
        }

        if ($user = \App\Models\User::where('id', $invite->user_id)->orWhere('email', $invite->user_email)->first()) {
            $this->user = $user;
        }
    }

    static function getSubject() {
        return 'Convite para participar do Tevep';
    }

    static function getBody() {
        return 'Você recebeu um convite para participar do Tevep "{{ $tevep->title }}". <br>
        Para participar, acesse o link abaixo: <br>
        <a href="{{ $tevepLink }}">{{ $tevepLink }}</a>';
    }
}