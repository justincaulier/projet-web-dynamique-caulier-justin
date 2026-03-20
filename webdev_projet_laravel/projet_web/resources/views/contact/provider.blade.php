@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                {{-- Titre --}}
                <h1 class="mb-4 text-center">Contacter {{ $provider->name }}</h1>

                {{-- Message flash --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif

                {{-- Formulaire --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('contact.provider.send', $provider->id) }}">
                            @csrf

                            {{-- Nom --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                       value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Message --}}
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bouton envoyer --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- Bouton retour --}}
                <div class="text-center mt-3">
                    <a href="{{ route('user.show', $provider->id) }}" class="btn btn-outline-secondary">← Retour au profil</a>
                </div>

            </div>
        </div>
    </div>

    {{-- Styles supplémentaires --}}
    <style>
        .card-body {
            padding: 2rem;
        }

        .btn-lg {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }

        h1 {
            font-weight: 600;
        }
    </style>
@endsection
