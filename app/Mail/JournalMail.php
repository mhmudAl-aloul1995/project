<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JournalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$password)
    {
        $this->name = $name;
        $this->password = $password;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $from_name = "Funda of Web IT";
        $from_email = "it@gu.edu.ps";
        $subject = "Funda of Web IT: You have a new query";
        return $this->from($from_email)
            ->view('main.email')
            ->subject($subject);


    }
}
