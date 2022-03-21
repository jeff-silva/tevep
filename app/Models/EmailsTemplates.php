<?php

namespace App\Models;

class EmailsTemplates extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'emails_templates';

	protected $fillable = [
		'id',
		'slug',
		'name',
		'subject',
		'body',
		'models',
		'params',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $casts = [
	    'params' => 'array',
	];


	public function toOutput()
	{
		$this->params = app($this->slug)->getParams();
	}
}
