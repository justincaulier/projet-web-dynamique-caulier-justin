@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2>Créer un nouveau utilisateur</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirmation de mot de passe :</label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control" value="{{ old('confirm-password') }}" required>
                @error('confirm-password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Valider l'inscription</button>
        </form>
    </div>
    <div class="mb-3">
        <a href="{{ route('google.redirect') }}" class="btn btn-danger">
            <img src="/public/images/" alt="google">
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
