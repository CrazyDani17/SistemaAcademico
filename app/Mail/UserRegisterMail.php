<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User; //USE STATEMENT MODEL CUSTOMER

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    //protected $randomPassword;

    public function __construct($user)
    {
        $this->user = $user;
        //$this->randomPassword = $randomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');

        //MENGESET SUBJECT EMAIL, VIEW MANA YANG AKAN DI-LOAD DAN DATA APA YANG AKAN DIPASSING KE VIEW
        return $this->subject('Verify Your Registration')
            ->view('email.register')
            ->with([
                'user' => $this->user,
            ]);
    }
}
