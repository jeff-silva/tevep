<?php

namespace App\Traits;

trait Model
{
    public function validate() {
        // 
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



    public function search($callback=null, $params=null) {

        $params = is_array($params)? $params: request()->all();
        $params = (object) array_merge([
            'perpage' => 15,
            'page' => 1,
            'search' => '',
            'orderby' => 'id',
            'order' => 'desc',
        ], $params);

        $query = $this->orderBy($params->orderby, $params->order);

        if (is_callable($callback)) {
            $query = call_user_func($callback, $query, request());
        }

        return $query->paginate($params->perpage);

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

    static function pushNotification($key, $data=[]) {
        $credentials = json_decode(base64_decode(env('FIREBASE_CREDENTIALS_BASE64_JSON')), true);
        if (! is_array($credentials)) return;
        $database = (new \Kreait\Firebase\Factory)->withServiceAccount($credentials)->createDatabase();
        return $database->getReference($key)->set($data);
    }
}