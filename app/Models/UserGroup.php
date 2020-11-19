<?php

namespace App\Models;

class UserGroup extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;

    protected $fillable = [
        'id',
        'name',
    ];
}
