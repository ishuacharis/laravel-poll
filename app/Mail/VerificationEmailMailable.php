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
    private $expires;
    public function __construct($user, $expires)
    {
        //
        $this->expires  = $expires;
        $this->user = $user;
        $this->url = "localhost:8000/api/email/verify/".$this->user->id."?expires=".$this->expires;
    
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
