@extends('layouts.layout')

@section('content')

    <h1>Contacter {{ $provider->name }}</h1>

    <form method="POST" action="{{ route('contact.provider.send', $provider->id) }}">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Message</label>
        <textarea name="message" required></textarea>

        <button type="submit">Envoyer</button>

    </form>

@endsection
