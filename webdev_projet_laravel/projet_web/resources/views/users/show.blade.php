@extends('layouts.layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="user-profile">
        <h1>{{ $user->name }} {{ $user->surname }}</h1>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $user->telephone }}</p>
        <p><strong>Adresse :</strong>
            {{ $user->address->street ?? '' }}
            {{ $user->address->number ?? '' }}
            {{ $user->address->box ?? '' }},
            {{ $user->address->postcode ?? '' }}
            {{ $user->address->city ?? '' }},
            {{ $user->address->country ?? '' }}
        </p>
        <p><strong>Role :</strong> {{ $user->role }}</p>
        <p><strong>Inscrit le :</strong> {{ $user->registered_at }}</p>
        <a href="{{ route('contact.provider', $user->id) }}" class="btn btn-primary">
            Contacter ce prestataire
        </a>
    </div>
    <a href="{{ route('home') }}">Retour à l'accueil</a>
    @if($user->address && $user->address->lat && $user->address->lon)

        <div style="width:600px;height:600px">

            <x-maps-leaflet
                :centerPoint="[
            'lat' => $user->address->lat,
            'long' => $user->address->lon
        ]"
                :zoomLevel="15"
                :markers="[
            [
                'lat' => $user->address->lat,
                'long' => $user->address->lon
            ]
        ]"
            />

        </div>

    @endif
@endsection
