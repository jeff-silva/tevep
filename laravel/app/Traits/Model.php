<?php

namespace App\Traits;

trait Model
{
    public static function bootModel()
    {
        static::retrieved(function($model) {
            $model->mutatorRetrieve();
        });

        static::saving(function($model) {
            $model->mutatorSave();

            $validate = $model->validate();
            if ($validate->fails()) {
                throw new \Exception(json_encode($validate->errors()));
            }

            if (in_array('slug', $model->getFillable()) AND !$model->slug AND $model->name) {
                $model->slug = \Str::slug($model->name);
            }

            foreach($model->attributes as $name => $value) {

                if ($file = request()->file($name)) {
                    $value = $model->upload($file);
                }

                else if (in_array($value, ['null', 'false', 'undefined', ''])) {
                    $value = null;
                }
                
                else if (in_array($value, ['true'])) {
                    $value = true;
                }

                else if (is_array($value)) {
                    $value = json_encode($value);
                }

                $model->attributes[ $name ] = $value;
            }
            
            return $model;
        });

        static::saved(function($model) {
            $model->mutatorRetrieve();
        });
    }


    public function mutatorSave()
    {
        // 
    }


    public function mutatorRetrieve()
    {
        // 
    }


    public static function permissions()
    {
        return [];
    }


    public function schemaFields()
    {
        return [
            'id' => 'default',
            'name' => 'default',
            'created_at' => 'default',
            'updated_at' => 'default',
            'deleted_at' => 'default',
        ];
    }


    public function getSchemaFields()
    {
        $defaults = [
            'id' => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
            'slug' => 'VARCHAR(255) NULL DEFAULT NULL',
            'name' => 'VARCHAR(255) NULL DEFAULT NULL',
            'created_at' => 'DATETIME NULL DEFAULT NULL',
            'updated_at' => 'DATETIME NULL DEFAULT NULL',
            'deleted_at' => 'DATETIME NULL DEFAULT NULL',
        ];
        
        $fields = [];

        foreach($this->schemaFields() as $field => $type) {
            if ($type=='default') {
                $type = $defaults[ $field ];
            }

            else if (is_array($type)) {
                $type = 'BIGINT(20) UNSIGNED NULL DEFAULT NULL';
            }

            $fields[ $field ] = $type;
        }

        return $fields;
    }


    public function getSchemaForeignKeys()
    {
        $fks = [];

        foreach($this->schemaFields() as $field => $type) {
            if (is_array($type)) {
                $fks[ $field ] = [
                    'class' => $type[0],
                    'table' => app($type[0])->getTable(),
                    'field' => $type[1],
                ];
            }
        }

        return $fks;
    }
    
    
    public static function seed()
    {
        return [];
    }


    public function getSingular()
    {
        return $this->singular? $this->singular: 'Item';
    }


    public function getPlural()
    {
        return $this->plural? $this->plural: 'Ítens';
    }


    public function userCan($pkeys)
    {
        $pkeys = is_array($pkeys)? $pkeys: [$pkeys];
        $userPermissions = [];

        if ($user = auth()->user()) {
            if ($user->id==1 OR $user->group_id==1) return true;
            if ($group = \App\Models\UsersGroups::select(['permissions'])->find($user->group_id)) {
                $userPermissions = is_array($group->permissions)? $group->permissions: [];
            }
        }

        foreach($pkeys as $i => $pkey) {
            if ($pkey[0]==':') {
                $pkey = $this->getTable() . $pkey;
            }

            if (! config("permissions.keys.{$pkey}")) {
                continue;
            }

            if (! in_array($pkey, $userPermissions)) {
                return false;
            }
        }

        return true;
    }


    public function validationRules()
	{
        return [
			'name' => ['required'],
		];
    }
    

    public function validate($data=null)
    {
        $data = $data===null? $this->attributes: $data;
        return \Validator::make($data, $this->validationRules());
    }


    public function upload($file)
    {
        $max_upload_size = intval(config('app_models_files.max_upload_size'));
        if ($file->getSize() AND $file->getSize() > $max_upload_size) {
            throw new \Exception('O arquivo enviado ultrapassou o tamanho permitido');
            return false;
        }

        $storage_type = config('app_models_files.storage_type'); // database | file
        $value = null;

        if ($storage_type=='database') {
            $type = preg_replace('/\/.+/', '', $file->getClientMimeType());
            $ext = $file->getClientOriginalExtension();
            $texts = ['svg', 'csv'];

            if ($type=='text' OR in_array($ext, $texts)) {
                $value = file_get_contents($file);
            }
            else {
                $value = 'data:'. $file->getClientMimeType() .';base64,'. base64_encode(file_get_contents($file));
            }
        }
        else if ($storage_type=='file') {
            $filename = \Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) .'.'. $file->getClientOriginalExtension();
            \Storage::disk('public')->put($filename, file_get_contents($file));
            $value = "/uploads/{$filename}";
        }

        return $value;
    }


    public function clone($id, $data=[]) {
        $model = self::find($id);
        if (!$model) {
            throw new \Exception('Model does not exists');
        }

        $new = $model->replicate()->fill(request()->all());
        $new->slug = null;
        $new->created_at = $new->updated_at = date('Y-m-d H:i:s');
        $new->deleted_at = null;
        $new->save();

        return $new;
    }



    public function exportUrls($params=[])
    {
        $params = $this->searchParamsDefault($params);

        foreach($params as $key => $value) {
            if (!$value OR in_array($key, ['page', 'per_page'])) {
                unset($params[ $key ]);
            }
        }

        $params = http_build_query($params);
        $namespace = \Str::of($this->getTable())->studly()->kebab();

        $return = [];
        foreach(\App\Converters\Converter::formats() as $format) {
            $return[] = [
                'ext' => $format->ext,
                'name' => $format->name,
                'url' => "/api/{$namespace}/export?format={$format->ext}&{$params}",
            ];
        }
        
        return collect($return);
    }
    


    // public function setSlugAttribute($value)
    // {
    //     $slug = isset($this->attributes['slug'])? $this->attributes['slug']: null;
    //     if (in_array('slug', $this->getFillable()) AND !$slug) {
    //         $this->attributes['slug'] = \Str::slug($this->name);
    //     }
    // }


    public function setDeletedAtAttribute($value)
	{
		$value = strtotime($value)? $value: null;
        $this->attributes['deleted_at'] = $value;
	}


    public function scopeNotEmpty($query, $fields)
    {
        $fields = is_array($fields)? $fields: [$fields];
        if (empty($fields)) return;

        $query->where(function($q) use($fields) {
            foreach($fields as $i => $field) {
                $q->orWhere(function($q) use($field) {
                    $q->whereNotNull($field);
                    $q->orWhere($field, '!=', '');
                });
            }
        });
    }


    public function dashboardData()
    {
        return [];
    }


    public function scopeWithJoin($query, $method, $fields=[], $params=[])
    {   
        $relation = call_user_func([$this, $method]);

        $params = (object) array_merge([
            'method' => 'join',
            'from' => $query->getModel()->getTable(),
            'table' => $relation->getRelated()->getTable(),
            'key' => $relation->getForeignKeyName(),
            'as' => $relation->getRelated()->getTable(),
            'field' => $relation->getLocalKeyName(),
        ], $params);

        call_user_func([$query, $params->method], "{$params->table} as {$params->as}", "{$params->as}.{$params->key}", '=', "{$params->from}.{$params->field}");

        $fields = array_map(function($field) use($params) {
            return "{$params->as}.{$field} as {$params->as}_{$field}";
        }, $fields);

        $query->selectRaw(implode(', ', $fields));
    }


    public function scopeFindIdOrSlug($query, $slugid)
    {
        $fillable = $this->fillable;
        $query->where(function($q) use($slugid, $fillable) {
            $q->where('id', $slugid);

            if (in_array('slug', $fillable)) {
                $q->orWhere('slug', $slugid);
            }
        });

        return $query->first();
    }


    public function exportFormats()
    {
        return \App\Converters\Converter::formats();
    }


    public function import($format, $content)
    {
        // 
    }


    public function delete()
    {
        if (! $this->id) return false;
        
        if (in_array('deleted_at', $this->fillable) AND !$this->deleted_at) {
            $this->deleted_at = date('Y-m-d H:i:s');
            $this->save();
            return true;
        }

        return parent::delete();
    }


    public function scopeExport($query, $format)
    {
        // dd(\App\Converters\Converter::format($format)->export($query));
        return \App\Converters\Converter::format($format)->export($query);
    }


    public function scopeDeleteAll($query, $params=null) {
        $return = [];
        foreach($query->get() as $item) {
            $item->delete();
            $return[] = $item->id;
        }
        return $return;
    }


    public function scopeRestoreAll($query)
    {
        $return = [];
        foreach($query->get() as $item) {
            $item->deleted_at = null;
            $item->save();
            $return[] = $item->id;
        }
        return $return;
    }

    public function scopeWhereDeleted($query, $deleted=true) {
        if (!in_array('deleted_at', $this->fillable)) return;

        if ($deleted) {
            $query->where(function($q) {
                $q->whereNotNull('deleted_at');
                $q->orWhere('deleted_at', '!=', '');
            });
        }
        else {
            $query->where(function($q) {
                $q->whereNull('deleted_at');
                $q->orWhere('deleted_at', '');
            });
        }

        return $query;
    }


    public function scopeSelectExcept($query, $fields=[]) {
        $select = [];
        foreach($this->fillable as $col) {
            if (in_array($col, $fields)) continue;
            $select[] = $col;
        }
        return $query->select($select);
    }


    public function searchParamsDefault($merge=[]) {
        return array_merge([
            'q' => '',
            'page' => 1,
            'perpage' => 20,
            'orderby' => 'updated_at',
            'order' => 'desc',
            'deleted' => '',
            'limit' => '',
        ], $this->searchParams(), $merge);
    }
    

    public function searchParams() {
        return [];
    }


    public function searchAttributes($params=[]) {
        return [];
    }


    public function searchQuery($query) {
        return $query;
    }


    public function scopeSearch($query, $params=null) {
        $searchParams = $this->searchParamsDefault();
        $params = $params? $params: request()->all();
        $params = array_merge($searchParams, $params);

        if ($query2 = $this->searchQuery($query, (object) $params)) {
            $query = $query2;
        }

        $query_table = $query->getModel()->getTable();

        foreach($params as $field=>$value) {
            if (! $value) continue;
            if (! in_array($field, $this->fillable)) continue;
            // if (in_array($field, $searchParams)) continue;
            $field = "{$query_table}.{$field}";
            $operator = isset($params["{$field}_op"])? $params["{$field}_op"]: 'eq';
            

            // ?status[]=progress&term[]=payment
            // where status in ('progress', 'payment')
            if (is_array($value)) {
                $query->whereIn($field, $value);
            }

            // ?price=1000&price_op=lt
            // where price < 1000
            else if ($operator=='lt') {
                $query->where($field, '<', $value);
            }
            
            // ?price=1000&price_op=lte
            // where price <= 1000
            else if ($operator=='lte') {
                $query->where($field, '<=', $value);
            }

            // ?price=1000&price_op=gt
            // where price > 1000
            else if ($operator=='gt') {
                $query->where($field, '>', $value);
            }

            // ?price=1000&price_op=gte
            // where price >= 1000
            else if ($operator=='gte') {
                $query->where($field, '>=', $value);
            }

            // ?status=finished&status_op=neq
            // where status != 'finished'
            else if ($operator=='neq') {
                $query->where($field, '!=', $value);
            }

            // ?title=search&title_op=like
            // where title like '%search%'
            else if ($operator=='like') {
                $query->where($field, 'like', "%{$value}%");
            }

            // ?title=search&title_op=nlike
            // where title not like '%search%'
            else if ($operator=='nlike') {
                $query->where($field, 'not like', "%{$value}%");
            }

            // ?stars[]=3&stars[]=4&stars_op=between
            // where stars between(3, 4)
            else if ($operator=='between') {
                $query->whereBetween($field, $value);
            }

            // ?stars[]=3&stars[]=4&stars_op=nbetween
            // where stars not between(3, 4)
            else if ($operator=='nbetween') {
                $query->whereNotBetween($field, $value);
            }

            // ?status=finished
            // where status='finished'
            else {
                $query->where($field, $value);
            }
        }

        // ?orderby=id&order=desc
        $order_by = "{$query_table}.{$params['orderby']}";
        $query->orderBy($order_by, $params['order']);

        // ?q=term+search
        if ($params['q']) {
            $terms = preg_split('/[^a-zA-Z0-9]/', $params['q']);
            $whereLikes = [];
            foreach($terms as $q) {
                foreach($this->fillable as $field) {
                    $field = "{$query_table}.{$field}";
                    $whereLikes[] = [$field, 'like', "%{$q}%"];
                }
            }
            $query = $query->where(function($q) use($whereLikes) {
                foreach($whereLikes as $w) {
                    $q->orWhere($w[0], $w[1], $w[2]);
                }
            });
        }

        // ?deleted=1
        $query->whereDeleted($params['deleted']);

        // ?limit=3
        if ($params['limit']) {
            $query->limit($params['limit']);
        }

        return $query;
    }



    public static function scopeToRawSql($query)
    {
        $sqlQuery = \Str::replaceArray(
        '?',
        collect($query->getBindings())
            ->map(function ($i) {
            if (is_object($i)) {
                $i = (string)$i;
            }
            return (is_string($i)) ? "'$i'" : $i;
            })->all(),
        $query->toSql()
        );

        return $sqlQuery;
    }
}