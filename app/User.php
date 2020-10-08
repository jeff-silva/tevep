<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'birth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($value){
        $this->attributes['password'] = \Hash::make($value);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    


    public function endpoints()
    {
        \Route::post('/auth/save-me/', function() {
            if ($user = User::find(request()->input('id'))) {
                $user->fill(request()->all());
                $user->save();
                return $user;
            }
            
            return ['error' => 'Erro ao salvar'];
        });
        
        \Route::post('/user/register/', function() {
            $request = request();
            $error = [];

            if (! $request->input('name')) {
                $error['name'] = isset($error['name'])? $error['name']: [];
                $error['name'][] = 'Informe seu none';
            }

            if (! filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
                $error['email'] = isset($error['email'])? $error['email']: [];
                $error['email'][] = 'E-mail inválido';
            }
            else if ($find = User::where('email', $request->input('email'))->first()) {
                $error['email'] = isset($error['email'])? $error['email']: [];
                $error['email'][] = 'E-mail já utilizado';
            }

            if (! $request->input('password')) {
                $error['password'] = isset($error['password'])? $error['password']: [];
                $error['password'][] = 'Informe a senha';
            }
            if ($request->input('password') != $request->input('password2')) {
                $error['password2'] = isset($error['password2'])? $error['password2']: [];
                $error['password2'][] = 'Senha e confirmação não batem';
            }

            if (!empty($error)) {
                $error = array_map(function($err) {
                    return implode($err, ' ');
                }, $error);

                return ['error' => $error];
            }

            else {
                $user = new User();
                $user->fill($request->all());
                $user->save();
                return $user;
            }

            return false;
        });
    }

    public function deployMigration($artisan, $table, $fields)
    {
        return [
            'name' => ['string'],
            'email' => ['string'],
            'birth' => ['dateTime'],
            'photo' => ['longText'],
            'email_verified_at' => ['timestamp'],
            'password' => ['string'],
            'remember_token' => ['rememberToken'],
        ];
    }

    public function deploySeed($artisan, $created)
    {
        if (!$root = \App\User::where('email', 'root@grr.la')->first()) {
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'name' => 'Root User',
                'email' => 'root@grr.la',
                'password' => \Illuminate\Support\Facades\Hash::make('321321'),
            ]);
        }
    }
}
