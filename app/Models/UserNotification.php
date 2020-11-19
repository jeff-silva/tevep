<?php

namespace App\Models;

class UserNotification extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;
    
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'user_id',
        'title',
        'body',
        'image',
        'seen',
    ];
}