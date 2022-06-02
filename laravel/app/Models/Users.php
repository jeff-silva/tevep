<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
	use \App\Traits\Model;

	protected $singular = 'Usuário';
	protected $plural = 'Usuários';
	protected $table = 'users';

	protected $fillable = [
		'id',
		'name',
		'email',
		'photo_id',
		'group_id',
		'address_id',
		'email_verified_at',
		'password',
		'remember_token',
		'created_at',
		'updated_at',
	];


	public $timestamps = false;

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
	    'password',
	    'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
	    // 'email_verified_at' => 'datetime',
	    // 'created_at' => 'datetime',
	    // 'updated_at' => 'datetime',
	];


	public function schemaFields()
	{
		return [
			'id' => 'default',
			'name' => 'VARCHAR(255) NOT NULL',
			'email' => 'VARCHAR(255) NOT NULL',
			'photo_id' => ['\App\Models\Files', 'id'],
			'group_id' => ['\App\Models\UsersGroups', 'id'],
			'address_id' => ['\App\Models\Places', 'id'],
			'email_verified_at' => 'DATETIME NULL DEFAULT NULL',
			'password' => 'VARCHAR(255) NOT NULL',
			'remember_token' => 'VARCHAR(100) NULL DEFAULT NULL',
			'created_at' => 'default',
			'updated_at' => 'default',
		];
	}


	public function getJWTIdentifier()
	{
		return $this->getKey();
	}


	public function getJWTCustomClaims()
	{
		return [];
	}


	public static function permissions()
	{
		return [
			'users-test' => 'Test',
		];
	}


	public function validationRules()
	{
		$rules = [
		    'name' => ['required'],
		    'email' => ['required', 'email:rfc,dns'],
		];

		// update
		if ($this->id) {
		    //
		}

		// insert
		else {
		    $rules['email'][] = 'unique:users,email';
		    $rules['password'] = ['required'];
		}

		return $rules;
	}


	public function mutatorSave()
	{
		if ($this->password) {
			if (\Hash::needsRehash($this->password)) {
				$this->password = \Hash::make($this->password);
			}
		}
		else { unset($this->password); }
	}


	public function mutatorRetrieve()
	{
		$this->photo_id = is_numeric($this->photo_id)? $this->photo_id: null;
	}


	public function searchQuery($query)
	{
		$query->select(['users.id', 'users.name', 'users.email']);

		$query->withJoin('photo', ['url'], [
			'method' => 'leftJoin',
			'as' => 'photo',
		]);

		$query->withJoin('group', ['id', 'name'], [
			'method' => 'leftJoin',
			'as' => 'group',
		]);
	}


	public function dashboardData()
	{
		$return['usersTotal'] = Users::select(['id'])->count();
		return $return;
	}


	public function page()
	{
		return $this->belongsTo(App\Models\Pages::class, 'owner_id', 'id');
	}


	public function photo()
	{
		return $this->hasOne(Files::class, 'id', 'photo_id');
	}


	public function photos()
	{
		return $this->hasMany(\App\Models\Files::class, 'id', 'photo_id');
	}


	public function group()
	{
		return $this->hasOne(UsersGroups::class, 'id', 'group_id');
	}


	public function groups()
	{
		return $this->hasMany(UsersGroups::class, 'id', 'group_id');
	}


	public function address()
	{
		return $this->hasOne(Places::class, 'id', 'address_id');
	}


	public function addresses()
	{
		return $this->hasMany(Places::class, 'id', 'address_id');
	}
}