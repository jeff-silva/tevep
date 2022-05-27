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

    static function getModels()
    {
        $models = array_map('realpath', glob(base_path("/app/Models/*")));
		$models = array_map(function($model) {
			$model = str_replace(base_path(), '', $model);
			$model = str_replace('\\app', '\App', $model);
			$model = str_replace('.php', '', $model);
			return app($model);
		}, $models);
        return $models;
    }
}