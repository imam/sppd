<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugReporting extends Mailable
{
    use Queueable, SerializesModels;
    public $mail_from;
    public $mail_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $content)
    {
        $this->mail_from = $from;
        $this->mail_content = $content;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('bug@sandbox50012e51d25348ef9f051916b55af2da.mailgun.org','SPPD Bug')
            ->view('mail.bug')
            ;
    }
}
