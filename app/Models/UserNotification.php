<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/* Uso
(new \App\Models\UserNotification)->store(['user_id'=>5, 'title'=>'Teste']);
ou
(new \App\Models\User)->notify(['title'=>'Teste']);
*/

class UserNotification extends Model
{
    use \App\Traits\Model;

    protected $fillable = [
		'id',
		'user_id',
		'title',
		'body',
		'image',
		'url',
		'seen',
		'created_at',
		'updated_at'
	];

    public function validate($data=[]) {
        return \Validator::make($data, [
            'user_id' => ['required'],
            'title' => ['required'],
        ]);
    }

	public function user() {
		return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
	}
}