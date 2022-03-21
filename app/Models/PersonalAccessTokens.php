<?php

namespace App\Models;

/**
 * Teste
 */
class PersonalAccessTokens extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'personal_access_tokens';

	protected $fillable = [
		'id',
		'tokenable_type',
		'tokenable_id',
		'name',
		'token',
		'abilities',
		'last_used_at',
		'created_at',
		'updated_at',
	];
}
