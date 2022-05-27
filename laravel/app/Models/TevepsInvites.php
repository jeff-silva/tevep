<?php

namespace App\Models;

class TevepsInvites extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	public $singular = 'Convite de Tevep';
	public $plural = 'Convites de Teveps';
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

	protected $fields = [
		'id' => 'default',
		'slug' => 'VARCHAR(255) NULL DEFAULT NULL',
		'name' => 'VARCHAR(255) NULL DEFAULT NULL',
		'user_id' => ['\App\Models\Users', 'id'],
		'user_email' => 'VARCHAR(255) NULL DEFAULT NULL',
		'status' => 'ENUM(\'accepted\', \'denied\') NULL DEFAULT NULL',
		'tevep_id' => ['\App\Models\Teveps', 'id'],
		'created_at' => 'default',
		'updated_at' => 'default',
		'deleted_at' => 'default',
	];


	public function mutatorSave()
	{
		if ($this->user_email AND !$this->user_id) {
			$this->user_id = Users::select(['id'])->where('email', $this->user_email)->value('id');
		}
	}


	public function validationRules()
	{
		if ($this->id) {
			return [];
		}

		$exists = self::query()
			->select('id')
			->where([
				'tevep_id' => $this->tevep_id,
				'user_email' => $this->user_email,
			])
			->get();

		if (!$exists->isEmpty()) {
			throw new \Exception("Convite já enviado para {$this->user_email}");
		}

		if ($user=auth()->user() AND $user->id==$this->tevep_id) {
			throw new \Exception('Você não pode se convidar para um evento');
		}

		return [
			'user_email' => ['required', 'email'],
			'tevep_id' => ['required'],
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
