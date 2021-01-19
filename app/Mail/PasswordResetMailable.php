<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $token;
    private $url;
    private $user;
    public function __construct($token, $user)
    {
        //
        $this->token = $token;
        $this->url =  "https://example.com/reset-password?token=".$this->token;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.password_reset',
        [
            'name' => $this->user->name,
            'token' => $this->token,
            'link' => $this->url
        ]);
    }
}
