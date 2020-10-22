<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        // dd(config('mail.mailers.smtp'));
        $this->user = $user;
        // $this->from(env('MAIL_FROM_ADDRESS'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->cc($this->user->email)->view('emails.user.created')->with([
            'user' => $this->user,
        ]);
    }
}
