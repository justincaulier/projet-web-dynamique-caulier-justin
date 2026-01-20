@extends('layouts.layout')

@section('content')
    <h1>Catégorie : {{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h2>Providers pour cette catégorie :</h2>

    @if($users->isNotEmpty())
        <ul>
            @foreach($users as $user)
                <li>
                    <a href="{{ route('user.show', $user->id) }}">
                        {{ $user->name }} {{ $user->surname }}
                        - {{($user->address)->city ?? '' }} ({{($user->address)->postcode ?? '' }})
                    </a>
                    <p>Catégorie(s) :
                        @foreach($user->categories as $c)
                            {{ $c->name }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucun provider trouvé pour cette catégorie.</p>
    @endif
@endsection
