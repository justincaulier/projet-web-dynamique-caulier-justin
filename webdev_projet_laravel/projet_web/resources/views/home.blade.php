@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row vh-100">

            {{-- Liste des catégories --}}
            <div class="col-2 bg-primary text-white p-3 d-flex flex-column" style="height: 100vh; overflow-y: auto;">
                <h4>Catégories</h4>
                <x-category-list :categories="$categories" />
            </div>

            {{-- Contenu principal --}}
            <div class="col-10 bg-light d-flex flex-column p-0">

                {{-- Slider --}}
                <div class="flex-grow-1">
                    <x-slider :images="$sliderImages" />
                </div>

                {{-- Barre de recherche + bouton S'inscrire --}}
                <div class="px-3 py-2 d-flex gap-2 align-items-center bg-white border-top">
                    <x-search-bar :query="$query ?? ''" class="flex-grow-1" />
                    <a href="{{ route('user.create') }}" class="btn btn-primary">S'inscrire</a>
                </div>
                @auth
                    <a href="{{ route('profile') }}" class="btn btn-secondary">Modifier mon profil</a>
                @endauth
                </div>
                {{-- Zone de recherche --}}
                <div class="px-3 mb-3">
                    <x-search-bar :query="$query ?? ''" />
                </div>

                {{-- Résultats --}}
                <div class="px-3 flex-grow-1 overflow-auto">
                    @if(!empty($query))
                        <h5>Résultats pour : "{{ $query }}"</h5>
                    @endif

                    @if(isset($users) && $users->isNotEmpty())
                        <ul class="list-group">
                            @foreach($users as $user)
                                <li class="list-group-item">
                                    <a href="{{ route('user.show', $user->id) }}">
                                        {{ $user->name }} {{ $user->surname }}
                                        - {{ $user->address->city ?? '' }} ({{ $user->address->postcode ?? '' }})
                                    </a>
                                    @if($user->categories->isNotEmpty())
                                        <p class="mb-0">Catégorie(s) :
                                            @foreach($user->categories as $category)
                                                {{ $category->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-3">
                            <x-pagination :items="$users" />
                        </div>
                    @else
                        <p>Aucun provider trouvé pour "{{ $query ?? 'tous' }}"</p>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <x-login-toggle />
                </div>

            </div> {{-- /Contenu principal --}}
        </div> {{-- /row --}}
    </div> {{-- /container-fluid --}}
@endsection
