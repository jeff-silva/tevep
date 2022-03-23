<?php

namespace App\Models;

class Teveps extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'teveps';

	protected $fillable = [
		'id',
		'slug',
		'name',
		'owner_id',
		'parent_id',
		'meta',
		'date_start',
		'date_final',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $casts = [
	    'meta' => 'array',
	];


	public function modelMutator()
	{
		$this->meta = is_array($this->meta)? $this->meta: [];
		$this->meta = array_merge([
			'tempos' => [],
			'pilotos' => [],
			'convidados' => [],
			'lugares' => [],
		], $this->meta);
	}
}
