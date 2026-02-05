{{--Layout de l'application--}}
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
            padding: 1.5rem;
        }

        header h1 {
            margin: 0;
            font-size: 1.6rem;
        }

        main {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
            justify-content: center;
        }

        .user-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .user-card {
            background-color: #ffffff;
            padding: 1.25rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .user-card h2 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .user-meta {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0.75rem;
        }

        .user-content {
            margin: 0;
            line-height: 1.6;
        }

        .no-data {
            text-align: center;
            padding: 2rem 1rem;
            background-color: #fef3c7;
            border-radius: 0.75rem;
            border: 1px solid #fbbf24;
            color: #92400e;
        }
        img {
            height: 150px;
            width: 150px;
        }
    </style>
</head>
<body>
<header>
    <h1>Site de bien-être</h1>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
