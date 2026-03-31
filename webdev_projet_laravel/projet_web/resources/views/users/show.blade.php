@extends('layouts.layout')

@section('content')
    <div class="user-profile">
        <h1>{{ $user->name }} {{ $user->surname }}</h1>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $user->telephone }}</p>
        <p><strong>Adresse :</strong> {{ $user->address }}</p>
        <p><strong>Role :</strong> {{ $user->role }}</p>
        <p><strong>Inscrit le :</strong> {{ $user->registered_at }}</p>
    </div>
    <a href="{{ route('home') }}">Retour à l'accueil</a>
@endsection
