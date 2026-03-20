@extends('layouts.layout')

@section('content')

    <div class="container-fluid main-layout">
        <div class="row">

            {{-- Sidebar Catégories --}}
            <aside class="col-12 col-md-3 col-lg-3 sidebar">
                <x-category-list :categories="$categories" />
            </aside>

            {{-- Contenu principal --}}
            <main class="col-12 col-md-9 col-lg-9 content">

                {{-- Slider --}}
                <x-slider :images="$sliderImages" />

                {{-- Recherche + Service à la une --}}
                <div class="row mb-4">
                    <div class="col-12 col-md-8 mb-3 mb-md-0">
                        <x-search-bar :query="$query ?? ''" />
                    </div>
                    <div class="col-12 col-md-4">
                        {{-- Catégorie à la une --}}
                        @if($highlightedCategory)
                            <div class="card featured-card hover-card text-center mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $highlightedCategory->name }}</h5>
                                    <p class="card-text">{{ $highlightedCategory->description ?? '' }}</p>
                                    <img src="{{ asset('storage/categories/' . $highlightedCategory->image) }}"
                                         alt="{{ $highlightedCategory->name }}"
                                         class="img-fluid rounded mb-3">
                                    <a href="{{ route('categories.show', $highlightedCategory->id) }}" class="btn btn-primary">
                                        Voir la catégorie
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-secondary text-center mb-4">
                                Aucune catégorie mise en avant pour le moment.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Partenaires récents --}}
                <div class="row mb-4 partners-row">
                    @foreach(range(1,4) as $i)
                        <div class="col-6 col-md-3 mb-3">
                            <div class="card partner-card hover-card d-flex align-items-center justify-content-center">
                                Partenaire récent
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Résultats recherche --}}
                @if(!empty($query))
                    <h5 class="mb-3">Résultats pour : "{{ $query }}"</h5>
                @endif

                @if(isset($users) && $users->isNotEmpty())
                    <ul class="list-group mb-3 user-list">
                        @foreach($users as $user)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <a href="{{ route('user.show', $user->id) }}" class="fw-bold">
                                    {{ $user->name }} {{ $user->surname }}
                                </a>
                                <span class="text-muted ms-2">{{ $user->address->postcode ?? '' }}</span>
                                @if($user->categories->isNotEmpty())
                                    <span class="badge bg-primary ms-2">{{ $user->categories->first()->name }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        <x-pagination :items="$users" />
                    </div>
                @endif

            </main>
        </div>
    </div>

@endsection
