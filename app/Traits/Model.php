<?php

namespace App\Traits;

trait Model
{
    public static function bootModel()
    {
        static::retrieved(function($model) {
            $model->toOutput();
        });

        static::saving(function($model) {

            if (in_array('slug', $model->getFillable())) {
                $model->slug = $model->slug? $model->slug: \Str::slug($model->name);
            }

            $model->toOutput();
            $validate = $model->validate();

            if ($validate->fails()) {
                throw new \Exception(json_encode($validate->errors()));
            }

            foreach($model->attributes as $name => $value) {

                if (in_array($value, ['null', 'false'])) {
                    $value = null;
                }

                else if (is_array($value)) {
                    $value = json_encode($value);
                }

                if ($file = request()->file($name)) {
                    $value = $model->upload($file);
                }

                $model->attributes[ $name ] = $value;
            }

            return $model;
        });
    }


    public function toOutput()
    {
        // return $this;
    }


    public static function permissions()
    {
        return [];
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


    public function validationRules() {
        return ['name' => 'required'];
    }
    

    public function validate($data=null)
    {
        $data = $data===null? $this->attributes: $data;
        return \Validator::make($data, $this->validationRules());
    }


    public function upload($file)
    {
        $max_upload_size = intval(config('app_model_files.max_upload_size'));
        if ($file->getSize() AND $file->getSize() > $max_upload_size) {
            throw new \Exception('O arquivo enviado ultrapassou o tamanho permitido');
            return false;
        }

        $storage_type = config('app_model_files.storage_type'); // database | file
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


    public function import($format, $content) {
        // 
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


    public function scopeExport($query) {
        $format = request('format', 'json');
        $filename = uniqid('download-'). ".{$format}";
        $mime = "application/{$format}";
        $all = $query->get()->toArray();

        if ($format=='csv') {
            $f = fopen('php://memory', 'r+');
            foreach ($all as $item) { fputcsv($f, $item, ';'); }
            rewind($f);
            $content = stream_get_contents($f);
        }

        else if ($format=='html') {
            $mime = 'text/html';
            $content = '<!DOCTYPE html><html lang="en"><head><title>'. $format .' export</title>';
            $content .= '<meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">';
            $content .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head>';
            $content .= '<body><table><thead>';
            foreach($all as $line=>$cols) {
                if ($line==0) {
                    $content .= '<thead><tr>';
                    foreach($cols as $name=>$value) { $content .= '<th>'. $name .'</th>'; }
                    $content .= '<tr></thead><tbody>';
                }

                $content .= '<tr>';
                foreach($cols as $name=>$value) { $content .= '<td>'. $value .'</td>'; }
                $content .= '</tr>';
                if ($line==sizeof($all)-1) { $content .= '</tbody>'; }
            }
            $content .= '</table></body></html>';
        }

        else {
            $content = json_encode($all);
        }

        return \Response::make($content, 200, [
            'Content-type' => $mime,
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }


    public function scopeDeleteAll($query, $params=null) {
        $params = $params===null? request()->all(): $params;
        $params = (object) array_merge([
            'forced' => '',
        ], $params);
        
        $return = [];
        $items = $query->get();

        if (\Schema::hasColumn($this->getTable(), 'deleted_at')) {
            foreach($items as $item) {
                if ($params->forced) {
                    $item->delete();
                    $return[] = $item;
                    continue;
                }

                $item->deleted_at = date('Y-m-d H:i:s');
                $item->save();
                $return[] = $item;
            }
        }

        return $return;
    }


    public function scopeRestoreAll($query)
    {
        $return = [];
        foreach($query->get() as $item) {
            $item->deleted_at = null;
            $item->save();
            $return[] = $item;
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
    

    public function searchParams() {
        return [];
    }


    public function searchQuery($query) {
        return $query;
    }


    public function scopeSearch($query, $params=null) {
        $searchParams = array_merge([
            'q' => '',
            'page' => 1,
            'perpage' => 20,
            'orderby' => 'updated_at',
            'order' => 'desc',
            'deleted' => '',
            'limit' => '',
        ], $this->searchParams());

        $params = $params? $params: request()->all();
        $params = array_merge($searchParams, $params);

        if ($query2 = $this->searchQuery($query, (object) $params)) {
            $query = $query2;
        }

        $query_table = $query->getModel()->getTable();

        foreach($params as $field=>$value) {
            if (! $value) continue;
            if (! in_array($field, $this->fillable)) continue;
            if (in_array($field, $searchParams)) continue;
            $field = "{$query_table}.{$field}";


            $operator = isset($params["{$field}_op"])? $params["{$field}_op"]: false;

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