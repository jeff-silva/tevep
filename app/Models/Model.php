<?php

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
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

    public function store() {
        // 
    }

    public function search($params=[]) {
        $params = (object) array_merge([
            'page' => 1,
            'search' => '',
            'perpage' => 20,
        ], $params);

        $attrs = $this->attributes;
        
        $query = new static;

        if ($params->search) {
            $query = $query->where(function($query) use($attrs) {
                foreach($attrs as $key=>$val) {
                    if (is_array($val)) continue;
                    $query->orWhere($key, 'like', "%{$val}%");
                }
            });
        }

        // return $query->toSql();
        return $query->paginate($params->perpage);
    }
}