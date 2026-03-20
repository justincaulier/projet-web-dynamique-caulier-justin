
@extends('layouts.layout')

@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

</head>

<body>

<!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1">Admin Panel</span>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">

                <h5 class="text-white mb-4">Menu</h5>

                <a href="#">Dashboard</a>

                <a href="{{ route('admin.categories.index') }}">
                    Catégories
                </a>

            </div>

            <!-- Content -->
            <div class="col-md-10 p-4">

                <h1 class="mb-4">Dashboard Admin</h1>

                <div class="row g-4">

                    <!-- Card Categories -->
                    <div class="col-md-4">
                        <div class="card shadow dashboard-card">
                            <div class="card-body">

                                <h5 class="card-title">
                                    Catégories
                                </h5>

                                <p class="card-text">
                                    Gérer les catégories du site.
                                </p>

                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                                    Accéder
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- Exemple autre card -->
                    <div class="col-md-4">
                        <div class="card shadow dashboard-card">
                            <div class="card-body">

                                <h5 class="card-title">
                                    Catégorie à la une
                                </h5>

                                <p class="card-text">
                                    Gérer la catégorie à la une
                                </p>

                                <a href="#" class="btn btn-primary">
                                    Accéder
                                </a>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
</body>
</html>
