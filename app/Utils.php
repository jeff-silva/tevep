<?php

namespace App;

class Utils
{
    static function classes()
    {
        $models = [];
        $files = glob(base_path(implode(DIRECTORY_SEPARATOR, ['app', '*.php'])));
        foreach($files as $file) {
            $model = '\App\\'. pathinfo($file, PATHINFO_FILENAME);
            if (class_exists($model) AND is_subclass_of($model, \Illuminate\Database\Eloquent\Model::class)) {
                $models[] = $model;
            }
        }
        return $models;

        // return [
        //     \App\Address::class,
        //     \App\Product::class,
        //     \App\User::class,
        // ];
    }
}
