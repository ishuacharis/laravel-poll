<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $url;
    private $user;
    public function __construct($user)
    {
        //
        $this->token = $token;
        $this->url =  "http://localhost:80/verify";
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.verification_email',
        [
            'name' => $this->user->name,
            'link' => $this->url
        ]);
    }
}
