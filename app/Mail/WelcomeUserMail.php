<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class WelcomeUserMail extends Mailable
{
   
    use Queueable, SerializesModels;
      public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $data)
    {
       $this->data=$data;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome-user');
    }
}
