<?php

namespace App\Models;

class Teveps extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	public $singular = 'Tevep';
	public $plural = 'Teveps';
	protected $table = 'teveps';

	protected $fillable = [
		'id',
		'slug',
		'name',
		'owner_id',
		'parent_id',
		'meta_ref',
		'meta',
		'date_start',
		'date_final',
		'created_at',
		'updated_at',
		'deleted_at',
	];


	public function mutatorSave()
	{
		if (!$this->owner_id AND $user=auth()->user()) {
			$this->owner_id = $user->id;
		}

		$this->meta = json_encode($this->metaDefault($this->meta));
	}


	public function mutatorRetrieve()
	{
		$this->meta = $this->metaDefault($this->meta);
	}


	public function metaDefault($meta)
	{
		$meta = json_decode($meta, true);
		$meta = is_array($meta)? $meta: [];
		return array_merge([
			'tempos' => [],
			'pilotos' => [],
			'convidados' => [],
			'lugares' => [],
			'utilidades' => [],
			'inerencias' => [],
			'expectativas' => [],
			'inovacoes' => [],
			'logisticas' => [],
			'relevancias' => [],
			'complexidades' => [],
			'custos' => [],
			'entregas' => [],
			'segurancas' => [],
			'atendimentos' => [],
			'qualidades' => [],
			'maquinas' => [],
			'materiais' => [],
			'maodeobras' => [],
			'meioambientes' => [],
			'metodos' => [],
		], $meta);
	}


	public function link()
	{
		return $this->id? url("/admin/teveps/{$this->id}"): null;
	}


	public function tevepsInvite()
	{
		return $this->belongsTo(App\Models\TevepsInvites::class, 'tevep_id', 'id');
	}
}
