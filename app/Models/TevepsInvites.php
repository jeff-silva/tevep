<?php

namespace App\Models;

class TevepsInvites extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'teveps_invites';

	protected $fillable = [
		'id',
		'slug',
		'name',
		'user_id',
		'user_email',
		'status',
		'tevep_id',
		'created_at',
		'updated_at',
		'deleted_at',
	];


	public function modelMutator()
	{
		if ($this->user_email AND !$this->user_id) {
			$this->user_id = User::select(['id'])->where('email', $this->user_email)->value('id');
		}
	}


	public function validationRules()
	{
		return [
			'user_email' => ['required', 'email'],
		];
	}


	public function tevep()
	{
		return $this->hasOne(Teveps::class, 'id', 'tevep_id');
	}


	public function teveps()
	{
		return $this->hasMany(\App\Models\Teveps::class, 'id', 'tevep_id');
	}
}
