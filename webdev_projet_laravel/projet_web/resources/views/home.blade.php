@extends('layouts.layout')

@section('content') <h1>Site Bien-être</h1>
    <div class="container-fluid">
        <div class="d-flex">
            <div class="bg-primary text-white" style="width: 20%; height: 100vh;">
                <x-category-list :categories="$categories" />
            </div>
            <div class="bg-light" style="width: 80%; height: 100vh;">
                <x-slider :images="$sliderImages" />
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    S'inscrire
                </a>
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
                <x-login-toggle />
            </div>

        </div>
    </div>
@endsection
