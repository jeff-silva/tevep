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
        $table_name = $this->getTable();
        $save = $this;

        if ($this->id) {
            $save = self::find($this->id)->fill($this->attributes);
        }
        
        $save->save();
        
        self::pushNotification("{$table_name}", $save);
        self::pushNotification("{$table_name}-{$save->id}", $save);
        return $save;
    }


    public function search($params=[]) {
        
        $params = (object) array_merge([
            'page' => 1,
            'search' => '',
        ], $params);

        return $this;

        // $attrs = $this->attributes;
        
        // $query = new static;

        // if ($params->search) {
        //     $query = $query->where(function($query) use($attrs) {
        //         foreach($attrs as $key=>$val) {
        //             if (is_array($val)) continue;
        //             $query->orWhere($key, 'like', "%{$val}%");
        //         }
        //     });
        // }

        // return $query;
    }

    static function fieldCreate($field, $callback) {
        $table_name = (new static)->getTable();

        if (! \Schema::hasTable($table_name)) {
            \Schema::create($table_name, function($table) {
                $table->increments('id');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
            });
        }

        if (\Schema::hasColumn($table_name, $field)) return;

        \Schema::table($table_name, function($table) use($callback) {
            call_user_func($callback, $table);
        });
    }

    static function fieldExists($field, $callback) {
        $table_name = (new static)->getTable();

        if (! \Schema::hasTable($table_name)) {
            \Schema::create($table_name, function($table) {
                $table->increments('id');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
            });
        }

        if (! \Schema::hasColumn($table_name, $field)) return;

        \Schema::table($table_name, function($table) use($callback) {
            call_user_func($callback, $table);
        });
    }

    static function pushNotification($key, $data=[]) {
        $credentials = json_decode(base64_decode(env('FIREBASE_CREDENTIALS_BASE64_JSON')), true);
        if (! is_array($credentials)) return;
        $database = (new \Kreait\Firebase\Factory)->withServiceAccount($credentials)->createDatabase();
        return $database->getReference($key)->set($data);
    }
}