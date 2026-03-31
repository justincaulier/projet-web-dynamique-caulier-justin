@auth
    <div>
        Bonjour <strong>{{ Auth::user()->name }}</strong>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
@else
    @php $id = uniqid('login_'); @endphp

    <button id="{{ $id }}_btn" type="button">
        Se connecter
    </button>

    <div id="{{ $id }}_form" class="login-hidden">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div style="margin-top:10px;">
                <label>Mot de passe</label>
                <input type="password" name="password">
            </div>

            <div style="margin-top:10px;">
                <button type="submit">Connexion</button>
            </div>
        </form>
    </div>

    <style>
        .login-hidden {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        .login-hidden.show {
            max-height: 300px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btn = document.getElementById('{{ $id }}_btn');
            const form = document.getElementById('{{ $id }}_form');

            btn.addEventListener('click', function () {
                form.classList.toggle('show');
            });
        });
    </script>
@endauth
