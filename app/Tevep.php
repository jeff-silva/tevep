<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tevep extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'divisor',
        'nodes',
        'date_start',
        'date_final',
    ];

    protected $attributes = [
        'user_id' => '',
        'title' => '',
        'divisor' => '',
        'nodes' => [],
        'date_start' => '',
        'date_final' => '',
    ];

    public function getNodesAttribute($value) {
        return is_array($value)? $value: json_decode($value);
    }

    public function setNodesAttribute($value) {
        $this->attributes['nodes'] = (is_array($value)? json_encode($value): $value);
    }

    public function validation() {
        $err = new \App\Error();

        if (!$this->user_id) {
            $err->add('user_id', 'É necessário um ID de usuário');
        }

        if (!$this->title) {
            $err->add('title', 'Informe o título');
        }

        return $err;
    }


    public function store() {
        if ($this->id AND $save=static::find($this->id)) {
            $save->fill($this->toArray())->update();
            return $save;
        }

        $save = $this->toArray();
        unset($save['id']);
        $save = static::create($save);
        return $save;
    }


    public function endpoints()
    {
        // \Route::post('/save', function() {
        //     $request = request();
        //     return $request->all();
        // });
    }


    public function search($params=[]) {
        $query = $this;

        if (isset($params['user_id']) AND $params['user_id']) {
            $query = $query->where('user_id', $params['user_id']);
        }

        return $query->get();
    }


    public function deployMigration($artisan, $table, $fields)
    {
        return [
            'user_id' => ['integer'],
            'title' => ['string'],
            'divisor' => ['string'],
            'nodes' => ['text'],
            'date_start' => ['dateTime'],
            'date_final' => ['dateTime'],
        ];
    }
}
