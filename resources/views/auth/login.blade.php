
<x-guest-layout>

    <style>
        .zara-login {
            text-align: center;
        }

        .zara-logo {
            font-size: 38px;
            font-weight: bold;
            letter-spacing: 5px;
            color: #17365d;
            margin-bottom: 5px;
        }

        .zara-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 25px;
        }

        .zara-title {
            font-size: 22px;
            font-weight: bold;
            color: #17365d;
            margin-bottom: 20px;
        }

        .zara-button {
            width: 100%;
            justify-content: center;
            background: #17365d !important;
            padding: 13px;
            border-radius: 7px;
            margin-top: 20px;
        }

        .zara-button:hover {
            background: #28558a !important;
        }
    </style>

    <div class="zara-login">

        <h1 class="zara-logo">ZARA</h1>

        <p class="zara-subtitle">
            Sistema Web de Ventas y Devoluciones
        </p>

        <h2 class="zara-title">
            Iniciar sesión
        </h2>

    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo electrónico -->
        <div>
            <x-input-label
                for="email"
                value="Correo electrónico" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Ingrese su correo electrónico" />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label
                for="password"
                value="Contraseña" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Ingrese su contraseña" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />
        </div>

        <!-- Recordarme -->
        <div class="block mt-4">
            <label for="remember_me"
                   class="inline-flex items-center">

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300
                           text-blue-700 shadow-sm">

                <span class="ms-2 text-sm text-gray-600">
                    Recordarme
                </span>
            </label>
        </div>

        <!-- Iniciar sesión -->
        <div>
            <x-primary-button
                class="zara-button">
                Iniciar sesión
            </x-primary-button>
        </div>

        <!-- Recuperar contraseña -->
        @if (Route::has('password.request'))
            <div class="text-center mt-4">
                <a href="{{ route('password.request') }}"
                   class="text-sm text-blue-700 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>
        @endif

    </form>

</x-guest-layout>
