<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de bien-être</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #1f2937;
            color: #ffffff;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }

        .header-buttons .btn {
            margin-left: 0.5rem;
        }

        /* Sidebar */
        .sidebar {
            background-color: #0d6efd;
            color: #fff;
            padding: 1rem;
            min-height: 100vh;
        }

        .sidebar-title {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #fff;
        }

        .category-list li a,
        .category-list li span {
            color: #fff !important;
        }

        .category-list li:hover {
            text-decoration: underline;
        }

        /* Contenu principal */
        .content {
            background-color: #f8f9fa;
            padding: 1rem;
        }

        /* Slider pro */
        .carousel-img {
            height: 400px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        /* Cartes */
        .featured-card, .partner-card {
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }

        .partners-row .partner-card {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Résultats recherche */
        .user-list li a {
            color: #000;
        }

        @media (max-width: 768px) {
            .carousel-img {
                height: 250px;
            }
            .partners-row .partner-card {
                height: 100px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Site de bien-être</h1>
    <div class="header-buttons">
        @guest
            <a href="{{ route('user.create') }}" class="btn btn-success">S'inscrire</a>
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal">
                Se connecter
            </button>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Déconnexion</button>
            </form>
        @endauth
    </div>
</header>

<main>
    @yield('content')
</main>

<!-- Modal Connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
