@extends('layouts.layout')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Mon profil - Internaute</h2>

        {{-- message succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{-- Nom --}}
            <div class="mb-3">
                <label class="form-label">Nom *</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="form-control">

                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- Prénom --}}
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text"
                       name="surname"
                       value="{{ old('surname', $user->surname) }}"
                       class="form-control">

                @error('surname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="form-control">

                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- Avatar --}}
            <div class="mb-3">
                <label class="form-label">Avatar</label>

                <input type="file"
                       name="avatar"
                       class="form-control">

                @error('avatar')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                @if($user->avatar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/avatars/'.$user->avatar) }}"
                             width="120"
                             class="rounded">
                    </div>
                @endif
            </div>


            <hr>

            <h4>Adresse</h4>

            {{-- Rue --}}
            <div class="mb-2">
                <input type="text"
                       name="street"
                       placeholder="Rue"
                       value="{{ old('street', $user->address->street ?? '') }}"
                       class="form-control">
            </div>


            {{-- Numéro --}}
            <div class="mb-2">
                <input type="text"
                       name="number"
                       placeholder="Numéro"
                       value="{{ old('number', $user->address->number ?? '') }}"
                       class="form-control">
            </div>


            {{-- Boite --}}
            <div class="mb-2">
                <input type="text"
                       name="box"
                       placeholder="Boîte"
                       value="{{ old('box', $user->address->box ?? '') }}"
                       class="form-control">
            </div>


            {{-- Ville --}}
            <div class="mb-2">
                <input type="text"
                       name="city"
                       placeholder="Ville"
                       value="{{ old('city', $user->address->city ?? '') }}"
                       class="form-control">
            </div>


            {{-- Code postal --}}
            <div class="mb-2">
                <input type="text"
                       name="postcode"
                       placeholder="Code postal"
                       value="{{ old('postcode', $user->address->postcode ?? '') }}"
                       class="form-control">
            </div>


            {{-- Pays --}}
            <div class="mb-3">
                <input type="text"
                       name="country"
                       placeholder="Pays"
                       value="{{ old('country', $user->address->country ?? '') }}"
                       class="form-control">
            </div>


            <button class="btn btn-primary">
                Mettre à jour
            </button>

        </form>

    </div>

@endsection

