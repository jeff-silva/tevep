<?php

/*
COMO DEFINIR CONFIGURAÇÕES PADRÃO?
- Insira as variáveis padrão dentro na array $settings dentro do método deploy
- Execute "php artisan app:deploy" para que a tabela, coluna e variáveis sejam criadas.
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $searchParams = [
        'per_page' => 0,
        'orderby' => 'id:desc',
    ];

    protected $settingsData = [
        'jwt.ttl' => ['description' => 'Tempo de duração da autenticação (em minutos)'],
        'mail.mailers.smtp.host' => ['description' => 'Host da conta de e-mail'],
        'mail.mailers.smtp.port' => ['description' => 'Porta'],
        'mail.mailers.smtp.username' => ['description' => 'Login do email'],
        'mail.mailers.smtp.password' => ['description' => 'Senha do e-mail'],
    ];

    public $timestamps = false;

    protected $fillable = [
		'id',
		'name',
		'value'
	];

    protected $appends = [
        'default',
        'description',
    ];

    public function getDefaultAttribute($value) {
        return config($this->name);
    }

    public function getDescriptionAttribute($value) {
        return isset($this->settingsData[$this->name])?
            $this->settingsData[$this->name]['description']:
            $this->name;
    }

    static function getValue($name, $default=null) {
        if ($set = \App\Models\Setting::where('name', $name)->first()) {
            return $set->value;
        }
        return $default;
    }


    public function saveAll($settings=[]) {
        foreach($settings as $i => $setting) {
            $settings[ $i ] = (new static)->fill($setting)->store();
        }
        return $settings;
    }
}
