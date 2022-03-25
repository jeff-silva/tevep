<?php

namespace App\Converters;

class Json extends Converter
{

    public $name = 'JSON';
    public $mime = 'application/json';
    public $ext = 'json';
    public $importable = true;

    public function import($model, $items=[])
    {
        // return json_decode($items, true);
    }

    public function export($query)
    {
        $this->content = json_encode($query->get());
        return $this;
    }
}