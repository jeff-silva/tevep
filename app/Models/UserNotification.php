<?php

namespace App\Models;

class UserNotification extends \App\Models\Model
{
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