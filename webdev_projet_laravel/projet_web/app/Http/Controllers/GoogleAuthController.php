<?php

namespace App\Http\Controllers;

use App\Exceptions\UserAlreadyExistsWithGivenEmail;
use App\Repositories\UserRepository;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    const GOOGLE_PROVIDER = 'google';
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Redirige l'utilisateur vers l'écran de connexion de Google
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver(self::GOOGLE_PROVIDER)->redirect();
    }

    /**
     * Connecte et/ou crée un utilisateur d'après la réponse de Google
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws UserAlreadyExistsWithGivenEmail
     */
    public function callback()
    {
        $oauthUser = Socialite::driver(self::GOOGLE_PROVIDER)->user();
        $provider = self::GOOGLE_PROVIDER;
        $providerId = $oauthUser->getId();
        $email = $oauthUser->getEmail();
        $name = $oauthUser->getName() ?? $oauthUser->getNickname() ?? 'User';

        // on vérifie si le compte est déjà lié à Google
        $user = $this->userRepository->findByProviderAndProviderId($provider, $providerId);

        if (!$user) {
            // sinon, on vérifie qu'un compte avec cet email n'existe pas déjà
            $existingByEmail = $this->userRepository->findByEmail($email);

            if ($existingByEmail) {
                // si c'est le cas, on throw une erreur personnalisée (bonne pratique !)
                throw new UserAlreadyExistsWithGivenEmail();
            }

            // sinon, on crée un nouveau compte OAuth
            $user = $this->userRepository->createUserForOAuth(
                $name,
                $email,
                $provider,
                $providerId
            );
        }

        // ensuite on authentifie l'utilisateur et on repart sur le système session + cookie
        Auth::login($user, remember: true);
        request()->session()->regenerate();

        return redirect('/');
    }
}
