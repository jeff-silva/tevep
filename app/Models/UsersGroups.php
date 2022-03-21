<?php

namespace App\Models;

class UsersGroups extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'users_groups';
	protected $fillable = ['id', 'slug', 'name', 'permissions', 'created_at', 'updated_at', 'deleted_at'];

	protected $casts = [
	    'permissions' => 'array',
	];


	public function user()
	{
		return $this->belongsTo(App\Models\User::class, 'group_id', 'id');
	}
}
