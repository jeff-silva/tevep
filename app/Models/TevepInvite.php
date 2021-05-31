<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TevepInvite extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $fillable = [
		'id',
		'tevep_id',
		'user_id',
		'user_email',
		'status',
		'created_at',
		'updated_at',
		'deleted_at'
	];

    protected $appends = [
        'links',
    ];

    public static function booted() {
        self::creating(function($model) {

            // se atributo user_email está preenchido...
            if ($model->user_email) {

                // ... e o e-mail do usuário existe no sistema...
                if ($user = \App\Models\User::where('email', $model->user_email)->first()) {
                    
                    // ... preenchemos o user_id com o id do mesmo
                    $model->user_id = $user->id;
                }
            }

            // ... se o user_email não está preenchido
            else {

                // ... mas o user_id está preenchido e o id existe no sistema
                if ($model->user_id AND $user = \App\Models\User::find($model->user_id)) {
                    
                    // ... preenchemos o user_email com o e-mail do mesmo
                    $model->user_email = $user->email;
                }
            }

            $inviteExists = static::where([
                'tevep_id' => $model->tevep_id,
                'user_id' => $model->user_id,
                'deleted_at' => null,
            ])->first();

            if ($inviteExists) {
                // talvez jogar uma exceção "convite já existe"
                return false;
            }
        });

        self::created(function($model) {
            (new \App\Mail\TevepInvite($model))->sendTo($model->user_email);
        });
    }

    public function getLinksAttribute() {
        $links = [];

        if ($this->tevep_id) {
            $links['tevep'] = \URL::to("/admin/tevep/{$this->tevep_id}");
        }

        if ($this->user AND $this->user->whatsapp) {
            $phone = preg_replace('/[^0-9]/', '', $this->user->whatsapp);
            $text = urlencode(implode("\n", [
                'Olá. Você está sendo convidado para editar um projeto Tevep',
                'Acesse o link abaixo para poder fazer alterações:',
                $links['tevep'],
            ]));
            $links['whatsapp'] = "https://api.whatsapp.com/send?phone={$phone}&text={$text}";
        }

        return $links;
    }

    public function validate($data=[]) {
        return \Validator::make($data, [
            'user_id' => ['required'],
        ]);
    }

    public function setUserIdAttribute($value) {
        if (! is_numeric($value)) {
            if ($user = \App\Models\User::where('email', $value)->first()) {
                $this->attributes['user_id'] = $user->id;
                return;
            }
        }

        $this->attributes['user_id'] = $value;
    }

    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }

	public function user() {
		return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
	}

	public function tevep() {
		return $this->belongsTo(\App\Models\Tevep::class, 'tevep_id', 'id');
	}
}