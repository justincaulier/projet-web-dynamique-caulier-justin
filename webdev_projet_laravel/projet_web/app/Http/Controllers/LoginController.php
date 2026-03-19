<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion.
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            // Validation
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            // Tentative de login
            if (!Auth::attempt($credentials)) {
                return back()->withInput()->withErrors(['email' => 'Identifiants invalides']);
            }

            // Regénère la session pour sécurité
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirection selon rôle
            if ($user->role === UserRole::ADMIN) {
                return redirect()->route('admin.dashboard')->with('success', 'Bienvenue sur le dashboard Admin');
            }

            return redirect()->route('profile')->with('success', 'Connexion réussie !');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de la connexion : '.$e->getMessage());
        }
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }
}
