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


    /* [
        // Predefined fields
        'select' => 'id,name',
        'orderby' => 'id:desc', // order by id desc
        'orderby' => ['id:desc', 'name:asc'], // order by id desc, name asc
        'page' => 1,
        'perpage' => 10,
        'q' => 'test', // where any field like '%{$q}%'

        // if field is a $fillable item:
        'age' => 35, // where age=35
        'age' => [35,36], // where age in (35, 36)
        'age' => ['op' => '=', 'value' => 35], // where age=35
        'age' => ['op' => '>', 'value' => 35], // where age > 35
        'age' => ['op' => '>=', 'value' => 35], // where age >= 35
        'age' => ['op' => '<', 'value' => 35], // where age < 35
        'age' => ['op' => '<=', 'value' => 35], // where age <= 35
        'age' => ['op' => 'in', 'value' => [35, 36]], // where age in (35, 36)
        'age' => ['op' => 'between', 'value' => [35, 36]], // where age between (35, 36)
        'age' => ['op' => 'empty'], // where (age is null or age='')
        'age' => [
            'relation' => 'or',
            ['field'=>'age', 'op'=>'=', 'value'=>35],
            ['field'=>'age', 'op'=>'=', 'value'=>36],
        ], // where ((age = 35) or (age = 36))
        'name' => ['op' => 'like', 'value' => 'john'], // where name like '%john%'
    ] */


    public function scopeQuerySearch($query, $params=null) {
        $params = $params? $params: request()->all();

        if (is_array($this->searchParams)) {
            $params = array_merge($this->searchParams, $params);
        }

        $params = array_merge([
            'q' => '',
            'relation' => 'or',
            'page' => 1,
            'perpage' => 10,
            'orderby' => 'updated_at:desc',
        ], $params);

        $operators = [
            '=' => function($q, $field, $values=[]) {
                return $q->where($field, '=', $values[0]);
            },
            '!=' => function($q, $field, $values=[]) {
                return $q->where($field, '!=', $values[0]);
            },
            '>' => function($q, $field, $values=[]) {
                return $q->where($field, '>', $values[0]);
            },
            '>=' => function($q, $field, $values=[]) {
                return $q->where($field, '>=', $values[0]);
            },
            '<' => function($q, $field, $values=[]) {
                return $q->where($field, '<', $values[0]);
            },
            '<=' => function($q, $field, $values=[]) {
                return $q->where($field, '<=', $values[0]);
            },
            'empty' => function($q, $field, $values=[]) {
                return $q->where(function($q) use($field) {
                    $q->whereNull($field);
                    $q->orWhere($field, '');
                });
            },
            'between' => function($q, $field, $values=[]) {
                return $q->whereBetween($field, $values);
            },
            'in' => function($q, $field, $values=[]) {
                return $q->whereIn($field, $values);
            },
        ];

        $_operate = function($query, $field, $values) use($operators) {
            $operator = array_shift($values);

            if (isset($operators[ $operator ])) {
                $query = call_user_func($operators[ $operator ], $query, $field, $values);
            }

            return $query;
        };

        foreach($params as $field=>$value) {
            if (! in_array($field, $this->fillable)) continue;
            
            if (is_array($value)) {
                if (in_array($value[0], array_keys($operators))) {
                    $query = $_operate($query, $field, $value);
                    continue;
                }

                // foreach($value as $value2) {
                //     if (in_array($value2[0], array_keys($operators))) {
                //         $query = $_operate($query, $field, $value2);
                //         continue;
                //     }
                // }
                
                continue;
            }

            // ?field=value
            $query = $query->where($field, $value);
        }


        // ?orderby=id:desc
        // ?orderby[]=id:desc&updated_at[]=id:desc
        $orders = is_array($params['orderby'])? $params['orderby']: [$params['orderby']];
        foreach($orders as $orderby) {
            $e = explode(':', $orderby);
            $field = isset($e[0])? $e[0]: 'id';
            $order = isset($e[1])? $e[1]: 'desc';
            $query = $query->orderBy($field, $order);
        }

        // ?q=term+search
        if ($params['q']) {
            $terms = preg_split('/[^a-zA-Z0-9]/', $params['q']);
            $whereLikes = [];
            foreach($terms as $q) {
                foreach($this->fillable as $field) {
                    $whereLikes[] = [$field, 'like', "%{$q}%"];
                }
            }
            $query = $query->where(function($q) use($whereLikes) {
                foreach($whereLikes as $w) {
                    $q->orWhere($w[0], $w[1], $w[2]);
                }
            });
        }

        return $query->paginate($params['perpage']);
    }


    // Retorna SQL final
    // $this->where('active', 1)->toRawSql();
    public function scopeToRawSql($query) {
        return call_user_func(function($query) {
            $sql = $query->toSql();
            $bindings = $query->getBindings();
            $needle = '?';
            foreach ($bindings as $replace){
                $pos = strpos($sql, $needle);
                if ($pos !== false) {
                    if (gettype($replace) === "string") {
                        $replace = ' "'.addslashes($replace).'" ';
                    }
                    $sql = substr_replace($sql, $replace, $pos, strlen($needle));
                }
            }
            return $sql;
        }, $query);
    }
    
    
    public function validate($data=[]) {
        return \Validator::make($data, []);
    }

    public function store($data=[]) {
        $data = array_merge($this->toArray(), $data);
        $pk = $this->getKeyName();
        $id = isset($data[$pk])? $data[$pk]: false;

        if ($validator = $this->validate($data) AND $validator->fails()) {
            throw new \Exception(json_encode([
                'message' => 'Há erros de validação',
                'fields' => $validator->errors(),
            ]));
        }

        if (!$id) unset($data[$pk]);
        return self::updateOrCreate([$pk => $id], $data);
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
}