<?php

namespace App\Mail;


class Model
{
    
    public $subject = '';
    public $body = '';

    public function bladeCompile($html, $data=[]) {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }

    public function send() {
        if (! $this->user) {
            $class = get_called_class();
            throw new \Exception("Erro na classe $class: parâmetro 1 do construct deve ser um \App\Models\User \$user");
        }

        $name = \Arr::last(explode('\\', get_called_class()));
        $subject = $this->subject;
        $body = $this->body;

        if ($email = \App\Models\Email::where('name', $name)->first()) {
            $subject = $email->subject;
            $body = $email->body;
        }

        $data = get_object_vars($this);
        $subject = $this->bladeCompile($subject, $data);
        $body = $this->bladeCompile($body, $data);
        \App\Utils::mail($this->user->email, $subject, $body);

        return true;
    }
}
