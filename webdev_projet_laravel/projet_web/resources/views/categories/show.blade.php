@extends('layouts.layout')

@section('content')
    <div class="container mt-5">

        {{-- Titre catégorie --}}
        <div class="mb-5 text-center">
            <h1 class="fw-bold">{{ $category->name }}</h1>
            <p class="text-muted">{{ $category->description }}</p>
        </div>

        {{-- Prestataires --}}
        <h2 class="mb-4">Prestataires pour cette catégorie :</h2>

        @if($users->isNotEmpty())
            <div class="row g-4">
                @foreach($users as $user)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm hover-card position-relative overflow-hidden">

                            {{-- Logo avec overlay et lien --}}
                            @if($user->logo)
                                <a href="{{ route('user.show', $user->id) }}" class="d-block position-relative">
                                    <img src="{{ asset('storage/logos/' . $user->logo) }}"
                                         alt="{{ $user->name }}"
                                         class="card-img-top"
                                         style="height:200px; object-fit:cover;">
                                    <div class="overlay d-flex justify-content-center align-items-center">
                                        <span class="btn btn-primary profile-btn">Voir profil</span>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('user.show', $user->id) }}">
                                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center"
                                         style="height:200px;">
                                        <i class="bi bi-person-fill" style="font-size:2rem;"></i>
                                    </div>
                                </a>
                            @endif

                            <div class="card-body">
                                <a href="{{ route('user.show', $user->id) }}" class="card-title h5 text-decoration-none text-dark">
                                    {{ $user->name }} {{ $user->surname }}
                                </a>
                                <p class="card-text text-muted mb-2">
                                    {{ $user->address->city ?? '' }} ({{ $user->address->postcode ?? '' }})
                                </p>
                                <p class="mb-0">
                                    @foreach($user->categories as $c)
                                        <span class="badge bg-primary category-badge">{{ $c->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                <x-pagination :items="$users" />
            </div>
        @else
            <p class="text-center text-muted">Aucun prestataire trouvé pour cette catégorie.</p>
        @endif

    </div>

    {{-- Styles pour hover et animations --}}
    <style>
        .hover-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.2);
        }

        /* Overlay sur logo */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .hover-card:hover .overlay {
            opacity: 1;
        }

        /* Bouton voir profil animation */
        .profile-btn {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .profile-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.2);
        }

        /* Badges animation au survol */
        .category-badge {
            transition: background-color 0.3s, transform 0.3s;
        }
        .category-badge:hover {
            background-color: #0d6efd;
            transform: scale(1.05);
        }
    </style>
@endsection
