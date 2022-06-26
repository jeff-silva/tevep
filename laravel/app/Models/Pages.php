<?php

namespace App\Models;

class Pages extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $singular = 'Página';
	protected $plural = 'Páginas';
	protected $table = 'pages';
	protected $fillable = ['id', 'slug', 'name', 'content', 'owner_id', 'created_at', 'updated_at', 'deleted_at'];


	public function schemaFields()
	{
		return [
			'id' => 'default',
			'slug' => 'VARCHAR(255) NOT NULL',
			'name' => 'VARCHAR(255) NOT NULL',
			'content' => 'LONGTEXT NOT NULL',
			'owner_id' => ['\App\Models\Users', 'id'],
			'created_at' => 'default',
			'updated_at' => 'default',
			'deleted_at' => 'default',
		];
	}


	public function mutatorRetrieve()
	{
		$this->content = call_user_func(function($content) {
			$content = is_array($content)? $content: json_decode($content, true);
			$content = $content? $content: [];
			$content['layout'] = isset($content['layout'])? $content['layout']: ['name'=>'', 'value'=>false, 'is'=>false];
			$content['sections'] = isset($content['sections'])? $content['sections']: [];
			return $content;
		}, $this->content);
	}


	public function owner()
	{
		return $this->hasOne(Users::class, 'id', 'owner_id');
	}


	public function owners()
	{
		return $this->hasMany(\App\Models\Users::class, 'id', 'owner_id');
	}
}
