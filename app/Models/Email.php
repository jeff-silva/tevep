<?php

namespace App\Models;

class Email extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;

    protected $fillable = [
		'id',
		'name',
		'subject',
		'body',
		'params',
		'created_at',
		'updated_at'
	];

    public function getParamsAttribute($value) {
        if (! is_array($value)) {
            $value = json_decode($value, true);
            $value = is_array($value)? $value: [];
        }
        return $value;
    }
    
    public function setParamsAttribute($value) {
        if (is_array($value) OR is_object($value)) {
            $value = json_encode($value);
        }
        $this->attributes['params'] = $value;
    }
}
