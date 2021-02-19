<?php

namespace Tevep\Models;

use Illuminate\Database\Eloquent\Model;

class Tevep extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;
    
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'nodes',
        'pingpongs',
        'date_start',
        'date_final',
    ];

    public function getNodesAttribute($value) {
        return json_decode($value, true);
    }

    public function getPingpongsAttribute($value) {
        return json_decode($value, true);
    }

    public function search($params=[]) {
        $query = $this;
        
        if (isset($params['user_id']) AND !empty($params['user_id'])) {
            $query = $query->where('user_id', $params['user_id']);
        }

        return $query;
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
