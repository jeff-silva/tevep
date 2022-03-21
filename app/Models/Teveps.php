<?php

namespace App\Models;

class Teveps extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'teveps';
	protected $fillable = ['id', 'slug', 'name', 'owner_id', 'created_at', 'updated_at', 'deleted_at'];
}
