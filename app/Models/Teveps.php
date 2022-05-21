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
		$meta = array_merge([
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

		foreach($meta as $attr => $values) {
			foreach($values as $index => $value) {
				$loop_is_last = $index==sizeof($values)-1;
				$value_prev = isset($values[ $index-1 ])? $values[ $index-1 ]: false;
				$value_next = isset($values[ $index+1 ])? $values[ $index+1 ]: false;
				$value = array_merge([
					'id' => '',
					'name' => '',
					'date_start' => '',
					'date_final' => '',
					'meta_ref' => uniqid(),
					'parent_id' => $this->id,
				], $value);

				// Setando data primeiro item
				if ($attr=='tempos' AND $index==0) {
					$value['date_start'] = $this->date_start;
				}

				if ($value_prev AND $value_prev['date_final'] AND !$value['date_start']) {
					$value['date_start'] = $value_prev['date_final'];
				}

				$meta[ $attr ][ $index ] = $value;
			}
		}

		return $meta;
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
