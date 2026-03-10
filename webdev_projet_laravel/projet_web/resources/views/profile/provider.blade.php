@extends('layouts.layout')

@section('content')

    <div class="container mt-4">

        <h2 class="mb-4">Mon profil - Prestataire</h2>

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

            {{-- Description --}}

            <div class="mb-3">
                <label class="form-label">Description</label>

                <input type="text"
                       name="description"
                       value="{{ old('description', $user->description) }}"
                       class="form-control">

                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- TVA --}}
            <div class="mb-3">
                <label class="form-label">Numéro TVA</label>

                <input type="text"
                       name="tva"
                       value="{{ old('tva', $user->tva) }}"
                       class="form-control">

                @error('tva')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            {{-- Logo --}}
            <div class="mb-3">
                <label class="form-label">Logo</label>

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

            <div class="mb-2">
                <input type="text"
                       name="street"
                       placeholder="Rue"
                       value="{{ old('street', $user->address->street ?? '') }}"
                       class="form-control">
            </div>

            <div class="mb-2">
                <input type="text"
                       name="number"
                       placeholder="Numéro"
                       value="{{ old('number', $user->address->number ?? '') }}"
                       class="form-control">
            </div>

            <div class="mb-2">
                <input type="text"
                       name="box"
                       placeholder="Boîte"
                       value="{{ old('box', $user->address->box ?? '') }}"
                       class="form-control">
            </div>

            <div class="mb-2">
                <input type="text"
                       name="city"
                       placeholder="Ville"
                       value="{{ old('city', $user->address->city ?? '') }}"
                       class="form-control">
            </div>

            <div class="mb-2">
                <input type="text"
                       name="postcode"
                       placeholder="Code postal"
                       value="{{ old('postcode', $user->address->postcode ?? '') }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <input type="text"
                       name="country"
                       placeholder="Pays"
                       value="{{ old('country', $user->address->country ?? '') }}"
                       class="form-control">
            </div>


            <hr>
            {{-- Gestion des photos supplémentaires --}}
            <h4>Photos supplémentaires</h4>

            <div class="mb-3">

                <input type="file"
                       name="photos[]"
                       multiple
                       class="form-control">

                @error('photos.*')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                @if($user->photos && $user->photos->count())
                    <div class="mt-3 d-flex flex-wrap gap-2">

                        @foreach($user->photos as $photo)

                            <img src="{{ asset('storage/providers_photos/'.$photo->path) }}"
                                 width="120"
                                 class="rounded">

                        @endforeach

                    </div>
                @endif

            </div>
            {{-- Gestion des catégories --}}
            <div class="mb-3">
                <label>Services proposés :</label>
                <select name="categories[]" class="form-select" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if(in_array($category->id, $user->categories->pluck('id')->toArray())) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Ctrl+clic pour sélectionner ou désélectionner plusieurs services</small>
            </div>


            <button class="btn btn-primary">
                Mettre à jour
            </button>

        </form>

    </div>

@endsection
