<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSent extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $fillable = [
        'to',
        'subject',
        'body',
        'created_at',
        'updated_at',
    ];

    public function getToAttribute($value) {
        if (is_string($value)) {
            return json_decode($value, true);
        }
        return $value;
    }
    
    static function send($to, $subject, $body, $data=[]) {
        $data = array_merge([
            'from' => config('mail.from'),
            'to' => (is_array($to)? $to: [$to]),
            'subject' => $subject,
            'body' => nl2br($body),
        ], $data);

        $smtp = config('mail.mailers.smtp');
        $smtp['host'] = \App\Models\Setting::find('mail.mailers.smtp.host')->value;
        $smtp['port'] = \App\Models\Setting::find('mail.mailers.smtp.port')->value;
        $smtp['username'] = \App\Models\Setting::find('mail.mailers.smtp.username')->value;
        $smtp['password'] = \App\Models\Setting::find('mail.mailers.smtp.password')->value;
        config()->set('mail.mailers.smtp', $smtp);

        \Mail::send('emails.mail', $data, function($mail) use($data) {
            $sent = $mail->from($data['from']['address'], $data['from']['name'])
            // $sent = $mail->from('MAIL_FROM_NAME', $data['from']['name'])
                ->subject($data['subject'])->to($data['to']);
        });
            
        if (empty(\Mail::failures())) {
            $data['to'] = json_encode($data['to']);
            return (new self)->fill($data)->store();
        }

        return false;
    }

    public function validationRules() {
        return [
            'nome' => 'required',
        ];
    }
}