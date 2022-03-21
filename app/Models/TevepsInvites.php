<?php

namespace App\Models;

class TevepsInvites extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'teveps_invites';
	protected $fillable = ['id', 'slug', 'name', 'tevep_id', 'created_at', 'updated_at', 'deleted_at'];
}
