<?php

namespace App\Utils;

class Utils {

    static function bladeCompile($html, $data=[])
    {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); dd($e->getMessage(), $html); }
        return ob_get_clean();
    }
}