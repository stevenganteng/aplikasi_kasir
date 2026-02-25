<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Parkir Grand Batam Mall</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black">

    <div class="bg-gray-900/90 backdrop-blur-md w-full max-w-md p-8 rounded-2xl shadow-2xl border border-yellow-600/30">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('logo_grandbatam.png') }}" 
                 alt="Grand Batam Mall"
                 class="w-40 mx-auto mb-4">

            <h1 class="text-xl font-semibold text-yellow-500 tracking-wide">
                Sistem Parkir
            </h1>

            <p class="text-sm text-gray-400 mt-2">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <x-auth-session-status class="mb-4 text-red-500" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm text-gray-300">Email</label>
                <input type="email" name="email" required
                    class="mt-1 w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                    placeholder="Masukkan email">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm text-gray-300">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                    placeholder="Masukkan password">
            </div>

            <!-- Remember & Forgot -->
            <div class="flex justify-between items-center mb-4 text-sm text-gray-400">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2 accent-yellow-500">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-yellow-500 hover:underline">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-yellow-600 hover:bg-yellow-500 text-black py-2 rounded-lg font-semibold transition duration-300">
                Login
            </button>
        </form>

        <p class="text-sm text-center mt-6 text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-yellow-500 font-semibold hover:underline">
                Daftar
            </a>
        </p>

    </div>

</body>
</html>