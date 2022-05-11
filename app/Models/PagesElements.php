<?php

namespace App\Models;

class PagesElements extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'pages_elements';
	protected $fillable = ['id', 'slug', 'name', 'type', 'comp', 'edit', 'created_at', 'updated_at', 'deleted_at'];
}
