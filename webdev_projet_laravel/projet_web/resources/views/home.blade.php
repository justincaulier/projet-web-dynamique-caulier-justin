@extends('layouts.layout')

@section('content')
    <div class="utilisateur-container">
        <h1>Site Bien-être</h1>
        <a href="{{ route('google.redirect') }}" class="btn btn-danger">
            Se connecter avec Google
        </a>
        <x-slider :images="$sliderImages" />

        <x-search-bar :query="$query ?? ''" />

        @if(isset($query))
            <h2>Résultats pour : "{{ $query }}"</h2>
            @if(isset($users) && $users->isNotEmpty())
                <ul>
                    @foreach($users as $user)
                        <li>
                            <a href="{{ route('user.show', $user->id) }}" class="text-blue-500 hover:underline">
                                {{ $user->name }} {{ $user->surname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aucun utilisateur trouvé pour "{{ $query }}"</p>
            @endif
        @endif

        <x-category-list :categories="$categories" />
    </div>
@endsection
