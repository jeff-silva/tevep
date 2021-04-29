<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tevep extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;
    
    protected $fillable = [
        'id',
        'user_id',
        'parent',
        'title',
        'level',
        'meta',
        'date_start',
        'date_final',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    public function getMetaAttribute($value) {
        if (! is_object($value)) {
            $value = json_decode($value);
        }

        return is_array($value)? $value: new \stdClass;
    }

    public function setMetaAttribute($value) {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['meta'] = $value;
    }

    public function validate($data=[]) {
        return \Validator::make($data, [
            'title' => ['required'],
        ]);
    }
}
