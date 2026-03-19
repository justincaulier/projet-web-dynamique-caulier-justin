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
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<span style="color:red">{{ $message }}</span>@enderror
            </div>

            <div style="margin-top:10px;">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
                @error('password')<span style="color:red">{{ $message }}</span>@enderror
            </div>

            <div style="margin-top:10px;">
                <button type="submit">Connexion</button>
            </div>

            @if(session('error'))
                <div style="color:red;margin-top:10px">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div style="color:green;margin-top:10px">{{ session('success') }}</div>
            @endif
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
