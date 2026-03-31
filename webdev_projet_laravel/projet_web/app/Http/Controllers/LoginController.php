<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            // Tente la connexion (déclenche une exception si échec)
            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Une erreur est survenue, veuillez réessayer.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
