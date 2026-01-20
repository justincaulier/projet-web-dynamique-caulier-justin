@extends('layouts.layout')

@section('content')
    <div class="utilisateur-container">
        <h1>Site Bien-être</h1>

        <x-slider :images="$sliderImages" />
        <x-search-bar :query="$query ?? ''" />

        @if(!empty($query))
            <h2>Résultats pour : "{{ $query }}"</h2>
        @endif

        @if(isset($users) && $users->isNotEmpty())
            <ul>
                @foreach($users as $user)
                    <li>
                        <a href="{{ route('user.show', $user->id) }}">
                            {{ $user->name }} {{ $user->surname }}
                            - {{ ($user->address)->city ?? '' }} ({{($user->address)->postcode ?? '' }})
                        </a>
                        @if($user->categories->isNotEmpty())
                            <p>Catégorie(s) :
                                @foreach($user->categories as $category)
                                    {{ $category->name }}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                        @endif
                    </li>
                @endforeach
            </ul>

            <x-pagination :items="$users" />


        @else
            <p>Aucun provider trouvé pour "{{ $query ?? 'tous' }}"</p>
        @endif

        <x-category-list :categories="$categories" />
    </div>
@endsection
