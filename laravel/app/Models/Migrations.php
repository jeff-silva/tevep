<?php

namespace App\Models;

class Migrations extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'migrations';
	protected $fillable = ['id', 'migration', 'batch'];
}
