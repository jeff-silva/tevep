<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tevep extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;
    
    protected $fillable = [
		'id',
		'user_id',
		'parent',
		'level',
		'title',
		'meta',
		'date_start',
		'date_final',
		'created_at',
		'updated_at',
		'deleted_at'
	];

    public function getMetaAttribute($value) {
        if (! is_object($value)) {
            $value = json_decode($value);
        }

        return is_array($value)? $value: new \stdClass;
    }

    public function setMetaAttribute($value) {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['meta'] = $value;
    }

    public function validate($data=[]) {
        return \Validator::make($data, [
            'title' => ['required'],
        ]);
    }

    // Model::search(['search'=>'Term']);
    public function scopeMyTeveps($query) {
        if ($user = \Illuminate\Support\Facades\Auth::user()) {
			$query = $query->where('user_id', $user->id);
            
            $invites_ids = \App\Models\TevepInvite::
                where('status', 'accepted')
                ->orWhereNull('status')
                ->where(['user_id' => $user->id])
                ->get()->pluck('tevep_id')->toArray();

            if (! empty($invites_ids)) {
                $query = $query->orWhereIn('id', $invites_ids);
            }
		}

        return $query;
    }

	public function user() {
		return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
	}

	public function tevep() {
		return $this->belongsTo(\App\Models\Tevep::class, 'parent', 'id');
	}
}