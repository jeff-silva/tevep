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
		'tevep_node',
		'user_id',
		'status',
		'created_at',
		'updated_at'
	];

    protected $appends = [
        'user',
        'invite_link',
    ];

    public function getUserAttribute() {
        if ($this->id AND $user=\App\Models\User::find($this->user_id)) {
            $user = $user->toArray();
            unset($user['group'], $user['groupInfo']);
            return $user;
        }
    }

    public function getInviteLinkAttribute() {
        if (! $this->id) return false;
        return url("/tevep/{$this->tevep_id}?invite={$this->id}");
    }

    public function validationRules() {
        return [
            'nome' => 'required',
        ];
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
}