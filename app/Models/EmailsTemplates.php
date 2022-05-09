<?php

namespace App\Models;

class EmailsTemplates extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $singular = 'Template de email';
	protected $plural = 'Templates de emails';
	protected $table = 'emails_templates';
	protected $fillable = ['id', 'slug', 'name', 'subject', 'body', 'params', 'created_at', 'updated_at', 'deleted_at'];

	protected $casts = [
	    'params' => 'array',
	];


	public function modelMutator()
	{
		if (! $this->slug) return [];
		$this->params = call_user_func([$this->slug, 'getParamsValues']);
	}


	public function test()
	{
		if (! $this->slug) return false;
		return call_user_func([$this->slug, 'test']);
	}
}
