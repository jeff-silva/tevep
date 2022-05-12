<?php

namespace App\Converters;

class Json extends Converter
{

    public $ext = 'json';
    public $name = 'JSON';
    public $mime = 'application/json';
    public $importable = true;

    public function import($model, $items=[])
    {
        // return json_decode($items, true);
    }

    public function exportQuery($query)
    {
        $this->content = json_encode($query->get());
    }
}