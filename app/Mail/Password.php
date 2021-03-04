<?php

namespace App\Mail;

use \App\Models\User;

class Password extends \App\Mail\Model
{
    // use Queueable, SerializesModels;

    public $subject = 'Recuperação de senha';

    public $body = 'Seu código de verificação:
<pre>{{ $code }}</pre>
Para prosseguir com a recuperação de senha, <a href="{{ url("/auth/password?code={$code}") }}">clique aqui</a>.';
    
    public $code;

    public function init($code) {
        $this->code = $code;
        return $this;
    }
}