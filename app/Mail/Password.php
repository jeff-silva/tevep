<?php

namespace App\Mail;

class Password extends \Illuminate\Mail\Mailable
{
    use \App\Traits\Mail;
    // use Queueable, SerializesModels;
    
    public $user;
    public $code;

    public function __construct(\App\Models\User $user, $code) {
        $this->user = $user;
        $this->code = $code;
    }

    static function getSubject() {
        return 'Recuperação de senha';
    }

    static function getBody() {
        return 'Seu código de verificação: <br><pre>{{ $code }}</pre>
        Para prosseguir com a recuperação de senha, <a href="{{ url("/auth/password?code={$code}") }}">clique aqui</a>.';
    }
}