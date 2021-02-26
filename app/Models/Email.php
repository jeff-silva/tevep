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
}
