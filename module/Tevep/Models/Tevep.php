<?php

namespace Tevep\Models;

use Illuminate\Database\Eloquent\Model;

class Tevep extends \App\Models\Model
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

    // public function deployMigration($artisan, $table, $fields)
    // {
    //     return [
    //         'user_id' => ['integer'],
    //         'title' => ['string'],
    //         'divisor' => ['string'],
    //         'nodes' => ['text'],
    //         'date_start' => ['dateTime'],
    //         'date_final' => ['dateTime'],
    //     ];
    // }
}
