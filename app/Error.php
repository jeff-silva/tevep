<?php

namespace App;

class Error
{
    public $errors = [];

    public function add($field, $message) {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }

    public function errors() {
        return array_map(function($err) {
            return implode('<br>', $err);
        }, $this->errors);
    }

    public function hasError() {
        return sizeof($this->errors)>0;
    }
}
