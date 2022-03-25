<?php

namespace App\Converters;

class Csv extends Converter
{

    public $name = 'CSV';
    public $mime = 'application/csv';
    public $ext = 'csv';
    public $importable = true;

    public function import($model, $items=[])
    {
        // return json_decode($items, true);
    }

    public function export($query)
    {
        $f = fopen('php://memory', 'r+');
        foreach ($query->get() as $model) { fputcsv($f, $model->toArray(), ';'); }
        rewind($f);
        $this->content = stream_get_contents($f);
        return $this;
    }
}