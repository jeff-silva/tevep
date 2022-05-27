<?php

namespace App\Converters;

class Converter
{
    public $ext;
    public $name;
    public $mime;
    public $importable = false;
    public $content = '';


    public function import($model, $items=[])
    {
        // return true;
    }

    
    public function exportQuery($query)
    {
        return $this;
    }

    public function getFilename()
    {
        return 'download-'. date('YmdHis');
    }


    public function export($query)
    {
        $this->exportQuery($query);
        return [
            'name' => ($this->getFilename() .'.'. $this->ext),
            'base64' => ("data:{$this->mime};base64,". base64_encode($this->content)),
        ];
    }


    static function format($ext)
    {
        foreach(self::formats() as $format) {
            if ($ext==$format->ext) {
                return $format;
            }
        }

        return false;
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