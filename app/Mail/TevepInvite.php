<?php

namespace App\Mail;


class TevepInvite extends \App\Mail\Model
{
    public $subject = 'Convite para participar do Tevep';

    public $body = 'Você recebeu um convite para participar do Tevep "{{ $tevep->title }}". <br>
    Para participar, acesse o link abaixo: <br>
    <a href="{{ $invite->invite_link }}">{{ $invite->invite_link }}</a>';

    public $invite = false;
    public $tevep = false;

    public function __construct(\App\Models\TevepInvite $invite) {
        $this->invite = $invite;

        if ($tevep = \App\Models\Tevep::find($invite->tevep_id)) {
            $this->tevep = $tevep;
        }
    }
}