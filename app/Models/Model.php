<?php

class Model extends Eloquent
{
    public static $autoValidates = true;
    protected static $rules = [];
    
    protected static function boot() {
        parent::boot();
        // or static::creating, or static::updating
        static::saving(function($model) {
            if ($model::$autoValidates) {
                return $model->validate();
            }
        });
    }
    
    public function validate()
    {
        // return \Utils::validate($data, $rules, $messages);
    }
}