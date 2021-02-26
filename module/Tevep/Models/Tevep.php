<?php

namespace Tevep\Models;

use Illuminate\Database\Eloquent\Model;

class Tevep extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;
    
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'nodes',
        'pingpongs',
        'date_start',
        'date_final',
    ];

    public function getNodesAttribute($value) {
        return json_decode($value, true);
    }

    public function getPingpongsAttribute($value) {
        $pingpongs = is_array($value)? $value: json_decode($value, true);
        $pingpongs = is_array($pingpongs)? $pingpongs: [];
        
        $users = \App\Models\User::whereIn('id', array_map(function($ping) {
            return $ping['user_to'];
        }, $pingpongs))->get();

        foreach($pingpongs as $i => $ping) {
            $pingpongs[ $i ]['invite_link'] = url("/tevep/{$this->id}/?pingpong={$ping['id']}");
            foreach($users as $user) {
                if ($user->id==$ping['user_to']) {
                    $pingpongs[ $i ]['user_to_name'] = $user->name;
                    $pingpongs[ $i ]['user_to_email'] = $user->email;
                    $pingpongs[ $i ]['user_to_whatsapp'] = $user->whatsapp;
                }
            }
        }

        return $pingpongs;
    }

    public function validation() {
        return [
            'title' => ['required'],
        ];
    }

    public function search($params=[]) {
        $query = $this;
        
        if (isset($params['user_id']) AND !empty($params['user_id'])) {
            $query = $query->where('user_id', $params['user_id']);
        }

        return $query;
    }

    public function pingpong($userId) {
        if (! $this->id) throw new \Exception('Tevep não encontrado');

        $user = \App\Models\User::find($userId);
        if (! $user) throw new \Exception('Usuário não encontrado');

        $pingpongs = is_array($this->pingpongs)? $this->pingpongs: [];
        
        // Nenhum usuário encontrado
        if (0 == sizeof(array_filter($pingpongs, function($ping) use($userId) { return $ping['user_to']==$userId; }))) {
            $pingpong = [
                'id' => uniqid('p'),
                'user_from' => $this->id,
                'user_to' => $userId,
                'user_to_name' => $user->name,
                'user_to_email' => $user->email,
                'invitations' => 1,
                'accepted' => false,
            ];

            $pingpong_link = url("/tevep/{$this->id}/?pingpong={$pingpong['id']}");
            
            \App\Utils::mail([
                'to' => $user->email,
                'subject' => 'Convite pingpong',
                'body' => "Para aceitar, clique <a href='{$pingpong_link}'>aqui</a>.",
            ]);

            $pingpongs[] = $pingpong;
        }

        // Usuário encontrado
        else {
            foreach($pingpongs as $i=>$ping) {
                if ($ping['user_to'] != $userId) continue;
                $ping['user_to_name'] = $user->name;
                $ping['user_to_email'] = $user->email;
                $ping['invitations'] = isset($ping['invitations'])? $ping['invitations']: 1;
                $ping['invitations']++;
                $pingpongs[$i] = $ping;

                $pingpong_link = url("/tevep/{$this->id}/?pingpong={$ping['id']}");

                \App\Utils::mail([
                    'to' => $user->email,
                    'subject' => 'Convite pingpong',
                    'body' => "Para aceitar, clique <a href='{$pingpong_link}'>aqui</a>.",
                ]);
            }
        }

        $this->pingpongs = $pingpongs;
        $this->store();
        return $this;
    }

    // public function deployMigration($artisan, $table, $fields)
    // {
    //     return [
    //         'user_id' => ['integer'],
    //         'title' => ['string'],
    //         'divisor' => ['string'],
    //         'nodes' => ['text'],
    //         'date_start' => ['dateTime'],
    //         'date_final' => ['dateTime'],
    //     ];
    // }
}
