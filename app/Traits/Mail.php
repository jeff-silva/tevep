<?php

namespace App\Traits;

trait Mail {

    static function getSubject() {
        return 'no subject';
    }

    static function getBody() {
        return 'no body';
    }

    static function getParams() {
        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        return array_diff($self, $parent);
    }

    public function bladeCompile($html, $data=[]) {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }

    public function sendTo($emails) {
        $name = (new \ReflectionClass($this))->getShortName();
        $email = \App\Models\Email::where('name', $name)->first();

        if (! $email) throw new \Exception("E-mail {$name} não encontrado");

        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        $keys = array_diff($self, $parent);

        $data = [];
        foreach($keys as $key) {
            $data[ $key ] = $this->{$key};
        }

        $emails = is_array($emails)? $emails: [$emails];
        $subject = $this->bladeCompile($email->subject, $data);
        $body = $this->bladeCompile($email->body, $data);

        return \App\Utils::mail($emails, $subject, $body);
    }

    public function send($emails) {
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
        \App\Utils::mail($emails, $subject, $body);

        return true;
    }
}