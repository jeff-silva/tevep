<?php

namespace App\Traits;

trait Model
{
    public static function bootModel() {
        $_function = function($model, $event) {
            $firebase_databaseurl = env('FIREBASE_DATABASEURL');
            $settings = json_decode(base64_decode(env('FIREBASE_CREDENTIALS_BASE64_JSON')), true);
            if (! is_array($settings)) return;

            $service_account = \Cache::remember('firebase-service-account', (60*24), function() use($settings) {
                return \Kreait\Firebase\ServiceAccount::fromValue($settings);
            });

            $factory = (new \Kreait\Firebase\Factory())->withServiceAccount($service_account)->withDatabaseUri($firebase_databaseurl);

            $table = $model->getTable();
            $factory->createDatabase()->getReference('push')->set([
                'app_name' => env('APP_NAME'),
                'url' => url('/'),
                'date' => date('Y-m-d H:i:s'),
                'session' => "{$table}:{$event}",
                'table' => $table,
                'model' => $model,
            ]);
        };

        self::created(function($model) use($_function) {
            $_function($model, 'created');
        });
        self::updated(function($model) use($_function) {
            $_function($model, 'updated');
        });
        self::deleted(function($model) use($_function) {
            $_function($model, 'deleted');
        });
    }
    
    
    public function validate($data=[]) {
        return \Validator::make($data, []);
    }

    public function store($data=[]) {
        $table_name = $this->getTable();
        $data = array_merge($this->toArray(), $data);
        $save = (new static)->fill($data);
        
        if ($this->id) {
            $save = (new static)->find($this->id)->fill($data);
        }

        if ($validator = $save->validate($data) AND $validator->fails()) {
            throw new \Exception(json_encode([
                'message' => 'Há erros de validação',
                'fields' => $validator->errors(),
            ]));
        }
        
        $save->save();
        
        // self::pushNotification("{$table_name}", $save);
        // self::pushNotification("{$table_name}-{$save->id}", $save);
        return $save;
    }


    public function remove($forced=false) {
        if (! $this->id) return false;
        
        if ($forced==false AND \Schema::hasColumn($this->getTable(), 'deleted_at')) {
            $this->deleted_at = date('Y-m-d H:i:s');
            $this->store();
            return $this;
        }

        $this->delete();
        return $this;
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

    public function apiSearch($params=[]) {
        $default_params = [
            'search' => '',
            'page' => '',
            'perpage' => 10,
            'orderby' => 'updated_at',
            'order' => 'desc',
        ];

        $params = array_merge($default_params, $params);

        // Define query
        $query = $this;

        // Where param equal field
        foreach(\Schema::getColumnListing($this->getTable()) as $field) {
            if (isset($params[$field])) {
                $query = $query->where($field, $params[$field]);
            }
        }

        // Search
        $search_terms = array_filter(preg_split('/[^a-zA-Z0-9]/', $params['search']), 'strlen');
        if (sizeof($search_terms)>0) {
            foreach($this->attributes as $key=>$val) {
                if ($key=='id') continue;
                foreach($search_terms as $search) {
                    $query = $query->orWhere($key, 'like', "%{$search}%");
                }
            }
        }

        // Equal
        foreach($this->attributes as $key=>$val) {
            if (isset($params[ $key ]) AND !empty($params[ $key ])) {
                $query = $query->where($key, $params[ $key ]);
            }
        }
        
        $query = $query->orderBy($params['orderby'], $params['order']);
        // dd(vsprintf(str_replace(array('?'), array('\'%s\''), $query->toSql()), $query->getBindings()));
        return $query->paginate($params['perpage']);
    }

    static function pushNotification($key, $data=[]) {
        $credentials = json_decode(base64_decode(env('FIREBASE_CREDENTIALS_BASE64_JSON')), true);
        if (! is_array($credentials)) return;
        $database = (new \Kreait\Firebase\Factory)->withServiceAccount($credentials)->createDatabase();
        return $database->getReference($key)->set($data);
    }
}