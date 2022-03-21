<?php

namespace App\Models;

/**
 * Teste
 */
class PasswordResets extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'password_resets';
	protected $fillable = ['email', 'token', 'created_at'];
}
