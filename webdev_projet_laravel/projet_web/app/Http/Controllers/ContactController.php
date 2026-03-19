<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactProviderRequest;
use App\Repositories\UserRepository;
use App\Services\MailService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    private UserRepository $userRepo;
    private MailService $mailService;

    public function __construct(UserRepository $userRepo, MailService $mailService)
    {
        $this->userRepo = $userRepo;
        $this->mailService = $mailService;
    }

    public function showProviderForm(int $id): View
    {
        try {

            $provider = $this->userRepo->show($id);

            return view('contact.provider', compact('provider'));

        } catch (\Exception $e) {

            abort(404, 'Prestataire introuvable');
        }
    }

    public function sendProviderMessage(ContactProviderRequest $request, int $id): RedirectResponse
    {
        try {

            $provider = $this->userRepo->show($id);

            $this->mailService->sendProviderContact(
                $provider,
                $request->validated()
            );

            return redirect()
                ->route('user.show', $provider->id)
                ->with('success', 'Votre message a bien été envoyé au prestataire.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error','Erreur lors de l\'envoi du message.');
        }
    }
}
