<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public string $verifyURL;
    public string $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $URL, string $name)
    {
        $this->name = $name;
        $this->verifyURL = $URL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('emails.verify')
            ->text('emails.verify_plain')
            ->subject('Account Activation')
            ->from('noreply@civilforum.org', 'CivilForum.org');
    }
}
