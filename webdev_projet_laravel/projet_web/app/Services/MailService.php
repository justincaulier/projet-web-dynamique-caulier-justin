<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendProviderContact(User $provider, array $data): void
    {
        Mail::raw(
            "Message de : {$data['name']} ({$data['email']})\n\n{$data['message']}",
            function ($mail) use ($provider) {
                $mail->to($provider->email)
                    ->subject('Nouveau message depuis la plateforme : Annuaire de bien-être');
            }
        );
    }
}
