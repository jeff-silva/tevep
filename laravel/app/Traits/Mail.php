<?php

namespace App\Traits;


trait Mail {

    static function getName()
    {
        return preg_replace('/[^a-zA-Z0-9]+/', '', get_called_class());
    }


    static function getSubject()
    {
        return preg_replace('/[^a-zA-Z0-9]+/', '', get_called_class());
    }


    static function getBody()
    {
        return ['hello :)'];
    }

    static function getParams()
    {
        return [];
    }


    static function test()
    {
        return new self();
    }


    public function setData($data=[])
    {
        $this->name = self::getName();

        $this->subject = self::getSubject();
        $this->subject = $this->bladeCompile($this->subject, $data);

        $this->body = self::getBody();
        $this->body = is_array($this->body)? implode("\n", $this->body): $this->body;
        $this->body = $this->bladeCompile($this->body, $data);
    }


    public function getParamsValues()
    {
        return collect(static::getParams())->map(function($value, $key) {
            return [
                'id' => $key,
                'name' => $value,
                'source' => "{{ $key }}",
            ];
        })->values();
    }


    public function bladeCompile($html, $data=[])
    {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }


    public function sendTo($emails)
    {
        $emails = is_array($emails)? $emails: [$emails];
        $subject = $this->subject;
        $body = $this->body;
        
        \Mail::send([], [], function ($message) use ($emails, $subject, $body) {
            $message->to($emails)->subject($subject)->setBody($body, 'text/html');
        });

        return $this;
    }
}