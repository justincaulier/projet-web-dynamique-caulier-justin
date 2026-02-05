<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Str;

class CompleteRegistrationMail extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function content(): Content
    {
        $url = url('/complete-registration/' . $this->user->id);

        return new Content(
            view: 'emails.complete-registration',
            with: ['url' => $url]
        );
    }

}
