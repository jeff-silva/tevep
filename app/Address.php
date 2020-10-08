<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $fillable = [
        'id',
        'name',
        'ref',
        'ref_id',
        'lat',
        'lng',
        'route',
        'number',
        'complement',
        'zipcode',
        'district',
        'city',
        'state',
        'st',
        'country',
        'co',
    ];

    protected $attributes = [
        'id' => false,
        'name' => '',
        'ref' => '',
        'ref_id' => '',
        'lat' => '',
        'lng' => '',
        'route' => '',
        'number' => '',
        'complement' => '',
        'zipcode' => '',
        'district' => '',
        'city' => '',
        'state' => '',
        'st' => '',
        'country' => '',
        'co' => '',
    ];

    public function addressByZipcode($zipcode)
    {
        $addr = new \App\Address(['zipcode'=>$zipcode]);
        return $addr;
    }

    public function endpoints()
    {
        \Route::get('/autocomplete', function() {
            $request = request();
            $results = [];

            $zipcode = $request->input('zipcode');
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $q = $request->input('q');

            // zipcode
            if ($zipcode) {
                $zipcode = preg_replace('/[^0-9]/', '', $zipcode);
                $resp = \Illuminate\Support\Facades\Http::get("https://viacep.com.br/ws/{$zipcode}/json/")->json();
                if (is_array($resp) AND isset($resp['cep'])) {
                    $q = urlencode("{$resp['logradouro']} {$resp['bairro']} {$resp['localidade']}");
                    $results = \Illuminate\Support\Facades\Http::get("https://nominatim.openstreetmap.org/search?q={$q}&format=json&addressdetails=1")->json();
                }
            }

            // latlng
            else if ($lat AND $lng) {
                $results[] = \Illuminate\Support\Facades\Http::get("https://nominatim.openstreetmap.org/reverse?lat={$lat}&lon={$lng}&format=json&addressdetails=1")->json();
            }

            // address
            else {
                $results = \Illuminate\Support\Facades\Http::get("https://nominatim.openstreetmap.org/search?q={$q}&format=json&addressdetails=1")->json();
            }

            return $results;
        });
        
        /*
        \Route::get('/address/search', function() {
            $input = request()->all();
            $query = new Address;
            
            if (array_key_exists('ref', $input)) {
                $query = $query->where('ref', $input['ref']);
            }
            
            if (array_key_exists('ref_id', $input)) {
                $query = $query->where('ref_id', $input['ref_id']);
            }
            
            return $query->get();
        });
        
        \Route::get('/address/find', function($request) {
            return $request->all();
        });
        
        \Route::post('/address/save', function() {
            $addr = Address::firstOrNew(['id' => request()->input('id')]);
            $addr->fill(request()->all());
            $addr->save();
            return $addr;
        });
        
        \Route::post('/address/delete', function($request) {
            return $request->all();
        });
        */
    }


    public function deployMigration($artisan, $table, $fields)
    {
        return [
            'name' => ['string'],
            'ref' => ['string'],
            'ref_id' => ['string'],
            'lat' => ['decimal', 10, 7],
            'lng' => ['decimal', 10, 7],
            'route' => ['string'],
            'number' => ['string'],
            'complement' => ['string'],
            'zipcode' => ['string'],
            'district' => ['string'],
            'city' => ['string'],
            'state' => ['string'],
            'st' => ['string'],
            'country' => ['string'],
            'co' => ['string'],
        ];
    }
}
