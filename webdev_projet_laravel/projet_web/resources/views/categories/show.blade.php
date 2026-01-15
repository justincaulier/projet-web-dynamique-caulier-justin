
@extends('layouts.layout')

@section('content')
    <div class="category-detail">
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        <a href="{{ route('home') }}">Retour à l'accueil</a>
    </div>
@endsection
