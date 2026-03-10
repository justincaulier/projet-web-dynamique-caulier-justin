@extends('layouts.layout')
@section('content')
        <div class="container mt-5">
            <h2>Créer un nouveau compte</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirmation :</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="form-control" required>
                    @error('confirm-password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Valider l'inscription</button>
            </form>
        </div>
    <div class="mb-3">
        <a href="{{ route('google.redirect') }}" class="btn btn-danger">
            <img src="/public/images" alt="google">
        </a>
    </div>
    <div>
        <button id="loginToggle" class="btn btn-primary">
            Se connecter
        </button>

        <div id="loginForm" style="display: none; margin-top: 15px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label>Email</label>
                    <input type="email" name="email" >
                </div>

                <div style="margin-top:10px;">
                    <label>Mot de passe</label>
                    <input type="password" name="password">
                </div>

                <div style="margin-top:10px;">
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>

    </div>
@endsection
