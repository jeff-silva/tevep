<?php

namespace App\Models;

class Places extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'places';

	protected $fillable = [
		'id',
		'name',
		'formatted',
		'route',
		'number',
		'complement',
		'zipcode',
		'district',
		'lat',
		'lng',
		'city',
		'state',
		'state_short',
		'country',
		'country_short',
		'created_at',
		'updated_at',
		'deleted_at',
	];


	public function validationRules()
	{
		return [
			// 'name' => ['required'],
		];
	}


	public function modelMutator()
	{
		$this->formatted = implode(array_filter([
			$this->route,
			($this->number? "nº {$this->number}": null),
			$this->complement,
			$this->district,
			$this->city,
			$this->state_short,
		], 'strlen'), ', ');
	}


	public function placeSearch($params = [])
	{
		$params = (object) array_merge([
			'search' => '',
		], $params);


		// Viacep search
		$respCep = false;
		if ($cep = preg_replace('/[^0-9]/i', '', $params->search) AND 8==strlen($cep)) {
			if ($respCep = (object) \Http::get("https://viacep.com.br/ws/{$cep}/json/")->json()) {
				$params->search = "{$params->search} {$respCep->logradouro} {$respCep->localidade} {$respCep->uf}";
			}
		}

		// Open street map results
		$return = [];
		$respPlaces = "https://nominatim.openstreetmap.org/search.php?format=json&addressdetails=1&extratags=1&namedetails=1&limit=10&q={$params->search}";
		if ($respPlaces = \Http::get($respPlaces)->json()) {
			foreach($respPlaces as $place) {
				$return[] = new self([
					'route' => $place['address']['road'],
					'zipcode' => ($respCep? $respCep->cep: ''),
					'district' => (isset($place['address']['suburb'])? $place['address']['suburb']: ''),
					'city' => $place['address']['city'],
					'state' => $place['address']['state'],
					'state_short' => ($respCep? $respCep->uf: ''),
					'country' => $place['address']['country'],
					'country_short' => $place['address']['country_code'],
					'lat' => $place['lat'],
					'lng' => $place['lon'],
				]);
			}
		}

		return $return;
	}


	public function user()
	{
		return $this->belongsTo(App\Models\Users::class, 'address_id', 'id');
	}
}
