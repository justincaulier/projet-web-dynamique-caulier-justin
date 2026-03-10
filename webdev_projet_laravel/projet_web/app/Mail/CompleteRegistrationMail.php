<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;

class CompleteRegistrationMail extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function content(): Content
    {
        // Générer l'URL via le nom de route correct
        $url = route('registration.storeComplete', $this->user->id);

        return new Content(
            view: 'emails.complete-registration',
            with: ['url' => $url]
        );
    }
}
