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

    public $timestamps = false;

    protected $fillable = [
		'id',
		'name',
		'value',
		'value_default',
		'description',
		'help'
	];

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


    public function deploy() {
        $settings = [
            'jwt.ttl' => [
                'description' => 'Tempo de duração da autenticação',
                'help' => '',
                'value' => config('jwt.ttl'),
            ],
            'mail.mailers.smtp.host' => [
                'description' => 'Host da conta de e-mail',
                'help' => '',
                'value' => config('mail.mailers.smtp.host'),
            ],
            'mail.mailers.smtp.port' => [
                'description' => 'Porta',
                'help' => '',
                'value' => config('mail.mailers.smtp.port'),
            ],
            'mail.mailers.smtp.username' => [
                'description' => 'Login do email',
                'help' => '',
                'value' => config('mail.mailers.smtp.username'),
            ],
            'mail.mailers.smtp.password' => [
                'description' => 'Senha do e-mail',
                'help' => '',
                'value' => config('mail.mailers.smtp.password'),
            ],
        ];

        foreach($settings as $name=>$setting) {
            $set = self::where('name', $name)->first();

            if (! $set) {
                $setting['name'] = $name;
                $setting['value_default'] = $setting['value'];
                (new static)->fill($setting)->save();
                continue;
            }

            $set->description = $setting['description'];
            $set->help = $setting['help'];
            $set->value_default = $setting['value'];
            $set->save();
        }
    }
}
