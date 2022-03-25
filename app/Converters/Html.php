<?php

namespace App\Converters;

class Html extends Converter
{

    public $name = 'HTML';
    public $mime = 'text/html';
    public $ext = 'html';

    public function import($model, $items=[])
    {
        // return json_decode($items, true);
    }

    public function export($query)
    {
        $content[] = '<!DOCTYPE html><html lang="en"><head>';
        $content[] = '<meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $content[] = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $content[] = '<title>Document</title></head><body><table><tbody>';

        foreach($query->get() as $i => $model) {
            if ($i==0) {
                $content[] = '<tr>';
                foreach($model->toArray() as $field => $value) {
                    $content[] = "<th>{$field}</th>";
                }
                $content[] = '</tr>';
            }

            $content[] = '<tr>';
            foreach($model->toArray() as $field => $value) {
                $content[] = "<td>{$value}</td>";
            }
            $content[] = '</tr>';
        }

        $content[] = '</tbody></table></body></html>';
        $this->content = implode('', $content);
        return $this;
    }
}