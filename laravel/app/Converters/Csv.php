<?php

namespace App\Converters;

class Csv extends Converter
{

    public $ext = 'csv';
    public $name = 'CSV';
    public $mime = 'application/csv';
    public $importable = true;

    public function import($model, $items=[])
    {
        // return json_decode($items, true);
    }

    public function exportQuery($query)
    {
        $f = fopen('php://memory', 'r+');
        foreach ($query->get() as $model) { fputcsv($f, $model->toArray(), ';'); }
        rewind($f);
        $this->content = stream_get_contents($f);
    }
}