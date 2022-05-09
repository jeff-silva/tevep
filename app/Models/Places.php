<?php

namespace App\Models;

class Places extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $singular = 'Local';
	protected $plural = 'Locais';
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
		$this->lat = floatval($this->lat ?? 0);
		$this->lng = floatval($this->lng ?? 0);
		$this->country_short = strtoupper($this->country_short);
		$this->state_short = strtoupper($this->state_short);
		$this->formatted = implode(array_filter([
			$this->route,
			(!!$this->number? "nº {$this->number}": null),
			$this->complement,
			$this->district,
			$this->city,
			$this->state_short,
		], 'strlen'), ', ');

		if (!$this->formatted) {
			$this->formatted = $this->country;
		}
	}


	public function searchParams()
	{
		return [
			'country_short' => '',
			'state_short' => '',
		];
	}


	public function searchAttributes($params = [])
	{
		$params = (object) $this->searchParamsDefault($params);

		$attrs['countries'] = self::select(['country', 'country_short'])
			->notEmpty('country_short')
			->distinct()
			->orderBy('country', 'asc')
			->get();

		$attrs['states'] = [];
		if ($params->country_short) {
			$attrs['states'] = self::select(['state', 'state_short'])
				->notEmpty('state_short')
				->where('country_short', $params->country_short)
				->distinct()->get();
		}

		return $attrs;
	}


	public function placeSearch($params = [])
	{
		$params = (object) array_merge([
			'search' => null,
			'lat' => null,
			'lng' => null,
		], $params);

		$_estadoSigla = function($name) {
			$name = mb_strtolower($name);
			$siglas = [
				'acre' => 'AC',
				'alagoas' => 'AL',
				'amapá' => 'AP',
				'amazonas' => 'AM',
				'bahia' => 'BA',
				'ceará' => 'CE',
				'distrito federal' => 'DF',
				'espirito santo' => 'ES',
				'goiás' => 'GO',
				'maranhão' => 'MA',
				'mato grosso do sul' => 'MS',
				'mato grosso' => 'MT',
				'minas gerais' => 'MG',
				'pará' => 'PA',
				'paraíba' => 'PB',
				'paraná' => 'PR',
				'pernambuco' => 'PE',
				'piauí' => 'PI',
				'rio de janeiro' => 'RJ',
				'rio grande do norte' => 'RN',
				'rio grande do sul' => 'RS',
				'rondônia' => 'RO',
				'roraima' => 'RR',
				'santa catarina' => 'SC',
				'são paulo' => 'SP',
				'sergipe' => 'SE',
				'tocantins' => 'TO',
			];

			return isset($siglas[$name])? $siglas[$name]: '';
		};

		$_osmToPlace = function($model, $place, $respCep=false) use($_estadoSigla) {
			if (!isset($place['address'])) {
				return new $model;
			}

			// dd($place);

			$place['route'] = (isset($place['address']['road'])? $place['address']['road']: '');
			$place['zipcode'] = (isset($place['address']['postcode'])? $place['address']['postcode']: ($respCep? $respCep->cep: ''));
			$place['district'] = (isset($place['address']['suburb'])? $place['address']['suburb']: '');
			$place['city'] = (isset($place['address']['city'])? $place['address']['city']: '');
			$place['state'] = (isset($place['address']['state'])? $place['address']['state']: ($respCep? $respCep->uf: ''));
			$place['state_short'] = $_estadoSigla($place['state']);
			$place['country'] = $place['address']['country'];
			$place['country_short'] = strtoupper(isset($place['address']['country_code'])? $place['address']['country_code']: '');
			$place['lat'] = $place['lat'];
			$place['lng'] = $place['lon'];

			if (isset($place['address']['ISO3166-2-lvl4'])) {
				$e = explode('-', $place['address']['ISO3166-2-lvl4']);
				$place['country_short'] = isset($e[0])? $e[0]: $place['country_short'];
				$place['state_short'] = isset($e[1])? $e[1]: $place['state_short'];
			}

			return new $model($place);
		};


		// Viacep search
		$respCep = false;
		if ($cep = preg_replace('/[^0-9]/i', '', $params->search) AND 8==strlen($cep)) {

			$key = md5(json_encode(['viacep', $cep]));
			$respCep = (object) \Cache::remember($key, 60*60*24*30, function() use($cep) {
				return \Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();
			});

			if ($respCep) {
				$params->search = "{$params->search} {$respCep->logradouro} {$respCep->localidade} {$respCep->uf}";
			}
		}

		// Busca coordenadas
		$respCoords = false;
		if ($params->lat AND $params->lng) {
			$key = md5(json_encode(['openstreetmap-coords', $params->lat, $params->lng]));
			$respCoords = \Cache::remember($key, 60*60*24*30, function() use($params) {
				return \Http::get('https://nominatim.openstreetmap.org/reverse?'. http_build_query([
					'format' => 'json',
					'addressdetails' => '1',
					'extratags' => '1',
					'namedetails' => '1',
					'limit' => '1',
					'lat' => $params->lat,
					'lon' => $params->lng,
				]))->json();
			});

			return [ $_osmToPlace($this, $respCoords) ];
		}


		// Open street map results
		$return = [];
		$key = md5(json_encode(['openstreetmap', $params->search]));
		$respPlaces = \Cache::remember($key, 60*60*24*30, function() use($params) {
			return \Http::get('https://nominatim.openstreetmap.org/search.php?'. http_build_query([
				'format' => 'json',
				'addressdetails' => '1',
				'extratags' => '1',
				'namedetails' => '1',
				'limit' => '10',
				'q' => $params->search,
			]))->json();
		});

		if (is_array($respPlaces)) {
			foreach($respPlaces as $place) {
				$return[] = $_osmToPlace($this, $place, $respCep);
			}
		}

		return $return;
	}


	public function user()
	{
		return $this->belongsTo(App\Models\Users::class, 'address_id', 'id');
	}
}
