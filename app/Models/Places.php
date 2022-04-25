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
	];


	public function user()
	{
		return $this->belongsTo(App\Models\Users::class, 'address_id', 'id');
	}
}
