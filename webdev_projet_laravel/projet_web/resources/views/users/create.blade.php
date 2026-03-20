@extends('layouts.layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">

                <h2 class="mb-4 text-center">Créer un nouveau compte</h2>

                {{-- Formulaire inscription --}}
                <div class="card shadow-sm p-4 mb-4">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirmation du mot de passe</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" required>
                            @error('confirm-password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">Créer mon compte</button>
                    </form>
                </div>

                {{-- Connexion avec Google --}}
                <div class="d-grid mb-4">
                    <a href="{{ route('google.redirect') }}" class="btn btn-danger">
                        <img src="{{ asset('images/google-logo.png') }}" alt="Google" style="height:20px; margin-right:10px;">
                        Se connecter avec Google
                    </a>
                </div>

                {{-- Formulaire connexion toggle --}}
                <div class="text-center mb-4">
                    <button id="loginToggle" class="btn btn-primary">Se connecter</button>
                </div>

                <div id="loginForm" class="card shadow-sm p-4" style="display: none;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="email" name="email" id="login-email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="login-password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="login-password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Connexion</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- JS toggle connexion --}}
    <script>
        const loginToggle = document.getElementById('loginToggle');
        const loginForm = document.getElementById('loginForm');

        loginToggle.addEventListener('click', () => {
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            loginToggle.textContent = loginForm.style.display === 'block' ? 'Masquer la connexion' : 'Se connecter';
        });
    </script>

@endsection
