@extends('layouts.layout')

@section('content')
    <div class="container mt-5">

        {{-- Message flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        {{-- Profil utilisateur avec logo et catégories --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body d-flex flex-column flex-md-row align-items-center">

                {{-- Logo --}}
                <div class="mb-3 mb-md-0 me-md-4 text-center">
                    @if($user->logo)
                        <img src="{{ asset('storage/logos/' . $user->logo) }}"
                             alt="{{ $user->name }}"
                             class="rounded-circle shadow-sm"
                             style="width:150px; height:150px; object-fit:cover;">
                    @else
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded-circle shadow-sm"
                             style="width:150px; height:150px;">
                            <i class="bi bi-person-fill" style="font-size:3rem;"></i>
                        </div>
                    @endif
                </div>

                {{-- Informations --}}
                <div class="flex-grow-1">
                    <h2 class="card-title mb-3">{{ $user->name }} {{ $user->surname }}</h2>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <p><strong>Email :</strong> {{ $user->email }}</p>
                            <p><strong>Téléphone :</strong> {{ $user->telephone ?? '-' }}</p>
                            <p><strong>Rôle :</strong> {{ $user->role }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p><strong>Adresse :</strong><br>
                                {{ $user->address->street ?? '' }}
                                {{ $user->address->number ?? '' }}
                                {{ $user->address->box ?? '' }}<br>
                                {{ $user->address->postcode ?? '' }} {{ $user->address->city ?? '' }}<br>
                                {{ $user->address->country ?? '' }}
                            </p>
                            <p><strong>Inscrit le :</strong> {{ $user->registered_at }}</p>
                        </div>
                    </div>

                    {{-- Catégories --}}
                    @if($user->categories->isNotEmpty())
                        <div class="mb-3">
                            @foreach($user->categories as $category)
                                <span class="badge bg-primary me-1">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Bouton contact --}}
                    <a href="{{ route('contact.provider', $user->id) }}" class="btn btn-primary btn-lg">
                        Contacter ce prestataire
                    </a>
                </div>

            </div>
        </div>

        {{-- Carte avec Leaflet si coordonnées disponibles --}}
        @if($user->address && $user->address->lat && $user->address->lon)
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <x-maps-leaflet
                        :centerPoint="[
                        'lat' => $user->address->lat,
                        'long' => $user->address->lon
                    ]"
                        :zoomLevel="15"
                        :markers="[
                        [
                            'lat' => $user->address->lat,
                            'long' => $user->address->lon
                        ]
                    ]"
                        class="rounded"
                        style="height:400px;"
                    />
                </div>
            </div>
        @endif

        {{-- Bouton retour --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Retour à l'accueil</a>
        </div>

    </div>

    {{-- Styles spécifiques --}}
    <style>
        .card-title {
            font-weight: 600;
            font-size: 1.8rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .category-badge {
            transition: background-color 0.3s, transform 0.3s;
        }
        .category-badge:hover {
            background-color: #0d6efd;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .card-body.d-flex {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
@endsection
