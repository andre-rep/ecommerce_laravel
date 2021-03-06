<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailBuilder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailConfirmation')
                    ->from($this->data['fromAddress'], $this->data['name'])
                    ->cc($this->data['fromAddress'], $this->data['name'])
                    ->bcc($this->data['fromAddress'], $this->data['name'])
                    ->replyTo($this->data['fromAddress'], $this->data['name'])
                    ->subject($this->data['subject'])
                    ->with([ 'test_message' => $this->data['message'] ]);
        
    }
}
