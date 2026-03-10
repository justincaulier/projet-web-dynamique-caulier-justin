@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h2>Complétez votre profil</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('registration.storeComplete', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nom / Prénom --}}
            <div class="mb-3">
                <label>Nom :</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label>Prénom :</label>
                <input type="text" name="surname" class="form-control" value="{{ old('surname', $user->surname) }}">
                @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
            </div>

            {{-- Checkbox prestataire --}}
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="is_provider" name="is_provider" value="1"
                    {{ old('is_provider', $user->role === 'PROVIDER' ? 1 : 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_provider">Je suis un prestataire</label>
            </div>

            {{-- Champs prestataire --}}
            <div id="provider_fields" style="display: none; margin-top: 15px;">
                <div class="mb-3">
                    <label>Description :</label>
                    <textarea name="description" class="form-control">{{ old('description', $user->description) }}</textarea>
                    @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label>Photo ou logo :</label>
                    <input type="file" name="photo" class="form-control">
                    @if($user->avatar)
                        <img src="{{ asset('storage/providers_photos/'.$user->avatar) }}"
                             class="mt-2 w-24 h-24 object-cover rounded">
                    @endif
                    @error('photo')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <h5>Adresse</h5>
                <div class="mb-2">
                    <input type="text" name="street" placeholder="Rue" class="form-control mb-2"
                           value="{{ old('street', optional($user->address)->street) }}">
                    @error('street')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <input type="text" name="number" placeholder="Numéro" class="form-control mb-2"
                           value="{{ old('number', optional($user->address)->number) }}">
                </div>
                <div class="mb-2">
                    <input type="text" name="box" placeholder="Boîte" class="form-control mb-2"
                           value="{{ old('box', optional($user->address)->box) }}">
                </div>
                <div class="mb-2">
                    <input type="text" name="city" placeholder="Ville" class="form-control mb-2"
                           value="{{ old('city', optional($user->address)->city) }}">
                    @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <input type="text" name="postcode" placeholder="Code postal" class="form-control mb-2"
                           value="{{ old('postcode', optional($user->address)->postcode) }}">
                </div>
                <div class="mb-2">
                    <input type="text" name="country" placeholder="Pays" class="form-control mb-2"
                           value="{{ old('country', optional($user->address)->country) }}">
                </div>

                <div class="mb-3">
                    <label>Numéro de TVA :</label>
                    <input type="text" name="tva" class="form-control" value="{{ old('tva', $user->tva) }}">
                </div>

                <div class="mb-3">
                    <label>Site web :</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $user->website) }}">
                </div>

                <div class="mb-3">
                    <label>Téléphone :</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $user->telephone) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Finaliser</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('is_provider');
            const providerFields = document.getElementById('provider_fields');

            function toggleProviderFields() {
                providerFields.style.display = checkbox.checked ? 'block' : 'none';
            }

            toggleProviderFields();
            checkbox.addEventListener('change', toggleProviderFields);
        });
    </script>
@endsection
