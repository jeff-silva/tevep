<?php

namespace App\Converters;

class Converter
{
    public $name;
    public $mime;
    public $ext;
    public $importable = false;
    public $content = '';


    public function import($model, $items=[])
    {
        // return true;
    }


    public function export($query)
    {
        $this->content = '';
        return $this;
    }


    static function format($format_id)
    {
        $format_id = 'App\Converters\\'. \Str::studly($format_id);
        foreach(self::formats() as $format) {
            if ($format_id==get_class($format)) {
                return $format;
            }
        }

        return new class extends Converter {};
    }


    static function formats()
    {
        $return = [];
        foreach(glob(__DIR__ . '/*.php') as $class) {
            $class = pathinfo($class, PATHINFO_FILENAME);
            if ($class=='Converter') continue;
            $return[] = app("\App\Converters\\{$class}");
        }

        return collect($return);
    }
}