<?php

namespace App\Models;

class PagesElements extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	public $singular = 'Elemento de Página';
	public $plural = 'Elementos de Páginas';
	protected $table = 'pages_elements';
	protected $fillable = ['id', 'slug', 'name', 'type', 'comp', 'edit', 'created_at', 'updated_at', 'deleted_at'];

	protected $fields = [
		'id' => 'default',
		'slug' => 'VARCHAR(255) NOT NULL',
		'name' => 'VARCHAR(255) NOT NULL',
		'type' => 'VARCHAR(20) NULL DEFAULT NULL',
		'comp' => 'LONGTEXT NULL DEFAULT NULL',
		'edit' => 'LONGTEXT NULL DEFAULT NULL',
		'created_at' => 'default',
		'updated_at' => 'default',
		'deleted_at' => 'default',
	];
}
