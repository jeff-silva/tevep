<?php

namespace App\Models;

class Email extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;

    protected $fillable = [
        'to',
        'subject',
        'body',
    ];
    
    static function send($to, $subject, $body, $data=[]) {
        $data = array_merge([
            'from' => config('mail.from'),
            'to' => (is_array($to)? $to: [$to]),
            'subject' => $subject,
            'body' => $body,
        ], $data);

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
}
