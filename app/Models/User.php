<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, \App\Traits\Model;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'photo',
        'background',
        'meta',
        'group',
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

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = $value? \Hash::make($value): null;
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    public function getBackgroundAttribute($value) {
        return $value? $value: 'https://source.unsplash.com/random/800x300/';
    }

    public function getPhotoAttribute($value) {
        return $value? $value: 'https://www.flaticon.com/svg/static/icons/svg/847/847969.svg';
    }

    public function getMetaAttribute($value) {
        $value = json_decode($value, true);
        $value = is_array($value)? $value: [];
        return array_merge([
            'photo' => 'https://www.flaticon.com/svg/static/icons/svg/847/847969.svg',
            'background' => '',
            'description' => '',
        ], $value);
    }

    public function setMetaAttribute($value) {
        if (is_array($value)) { $value = json_encode($value); }
        $this->attributes['meta'] = $value;
    }

    
    protected $appends = ['groupInfo'];

    public function getGroupInfoAttribute() {
        $group = isset($this->attributes['group'])? $this->attributes['group']: null;
        return self::group($group);
    }


    // https://laravel.com/docs/8.x/validation#available-validation-rules
    public function validate($data=[]) {
        $data = array_merge(['id'=>''], $data);

        $rules = [
            'name' => 'required',
            'email' => "required|email:rfc,dns|unique:users,email,{$data['id']}",
        ];

        $password_rules = [];

        if ($data['id']) {
            $password_rules[] = 'sometimes';
        }
        else {
            $password_rules[] = 'required';
        }

        if (in_array('password_confirmation', array_keys($data))) {
            $password_rules[] = 'required_with:password_confirmation';
            $password_rules[] = 'same:password_confirmation';
        }

        if (! empty($password_rules)) {
            $rules['password'] = implode('|', $password_rules);
        }


        $messages = [
            'name.required' => 'Informe o nome',
            'email.email' => 'E-mail inválido',
            'email.required' => 'Informe o e-mail',
            'email.unique' => 'E-mail já utilizado',
            'password.required' => 'Informe a senha',
            'password.same' => 'Senha e confirmação não batem',
        ];

        return \App\Utils::validate($data, $rules, $messages);
    }


    public function store() {
        $save = $this;
        
        if ($save->id) {
            $save = self::find($save->id)->fill($save->attributes);
        }
        
        $save->save();

        if ($save->wasRecentlyCreated) {
            \App\Models\Email::send($save->email, "Bem vindo {$save->name}!", "Bem vindo {$save->name}! <br>Seu cadastro acaba de ser efetuado, é um prazer ter você conosco.");
        }
        
        return $save;
    }


    static function passwordToken($data=[]) {
        $data = array_merge(['email'=>''], $data);

        $rules = [
            'email' => 'required|email:rfc,dns',
        ];

        \App\Utils::validate($data, $rules);

        $set = \Illuminate\Support\Facades\Password::sendResetLink(['email'=>$data['email']], function($mail) use($data) {
            // $mail->bcc($data['email']);
            // $mail->subject('Alteração de senha');
        });

        if ($reset = \DB::table('password_resets')->where('email', '=', $data['email'])->first()) {
            \App\Models\Email::send($data['email'], 'Recuperação de senha', "Informe seu código de recuperação de senha para prosseguir com a alteração: <br>
                <div style='padding:15px; background:#eee;'>{$reset->token}</div>");
        }

        return $set;
    }

    static function passwordReset($data=[]) {
        $data = array_merge([
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'token' => '',
        ], $data);

        $rules = [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'token' => 'required',
        ];

        \App\Utils::validate($data, $rules);

        if ($reset = \DB::table('password_resets')->where('email', '=', $data['email'])->where('token', '=', $data['token'])->first()) {
            $user = static::where('email', '=', $data['email'])->first();
            $user->password = $data['password'];
            return $user->save();
        }
        
        throw new \Exception('Token ou email inválido');
    }

    public function notify($data=[]) {
        return \App\Models\UserNotification::create(array_merge([
            'user_id' => $this->id,
            'title' => '',
            'body' => '',
            'image' => '',
            'seen' => '0',
        ], $data));
    }

    public function notifications($data=[]) {
        $data = (object) array_merge([
            'seen' => null,
        ], $data);

        $query = new \App\Models\UserNotification;

        if ($data->seen!==null) {
            $query = $query->where('seen', $data->seen);
        }

        return $query;
    }


    static function groups() {
        $groups[] = [
            'id' => '',
            'name' => 'User',
            'menu' => [
                ['to'=>'/dashboard', 'title'=>'Dashboard', 'icon'=>'fas fa-home', 'children'=>[]],
                ['to'=>'', 'title'=>'Tevep', 'icon'=>'fas fa-shopping-bag', 'children'=>[
                    ['to'=>'/tevep/', 'title'=>'Projetos', 'icon'=>'fas fa-shopping-bag', 'children'=>[]],
                    ['to'=>'/tevep/0/', 'title'=>'Novo', 'icon'=>'fas fa-shopping-bag', 'children'=>[]],
                ]],
                ['to'=>'', 'title'=>'Configurações', 'icon'=>'fas fa-cog', 'children'=>[
                    ['to'=>'/user/me/', 'title'=>'Meus dados', 'icon'=>'fas fa-cog', 'children'=>[]],
                ]],
            ],
        ];

        $groups[] = [
            'id' => 'root',
            'name' => 'Root Group',
            'menu' => [
                ['to'=>'/dashboard', 'title'=>'Dashboard', 'icon'=>'fas fa-home', 'children'=>[]],
                ['to'=>'', 'title'=>'Tevep', 'icon'=>'fas fa-shopping-bag', 'children'=>[
                    ['to'=>'/tevep/', 'title'=>'Projetos', 'icon'=>'fas fa-shopping-bag', 'children'=>[]],
                    ['to'=>'/tevep/0/', 'title'=>'Novo', 'icon'=>'fas fa-shopping-bag', 'children'=>[]],
                ]],
                ['to'=>'/user', 'title'=>'Usuários', 'icon'=>'fas fa-user', 'children'=>[]],
                ['to'=>'', 'title'=>'Configurações', 'icon'=>'fas fa-cog', 'children'=>[
                    ['to'=>'/user/me/', 'title'=>'Meus dados', 'icon'=>'fas fa-cog', 'children'=>[]],
                ]],
            ],
        ];

        return $groups;
    }


    static function group($id=false) {
        foreach(self::groups() as $group) {
            if ($group['id']==$id) {
                return $group;
            }
        }

        return false;
    }
}
