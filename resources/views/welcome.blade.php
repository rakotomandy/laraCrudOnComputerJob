<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen bg-gradient-to-tr from-pink-500 via-purple-600 to-indigo-600 flex items-center justify-center">

    <!-- Rotated Card -->
    <div class="relative w-full max-w-md">
        <div
            class="absolute inset-0 transform rotate-3 bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 rounded-3xl shadow-2xl">
        </div>

        <div class="relative bg-white rounded-3xl shadow-xl p-10">

            <!-- Logo / Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-700">Login Portal</h1>
                <p class="text-gray-500 mt-2">Access your dashboard</p>
            </div>

            <!-- Form -->
            <form action="{{route("student.login")}}" class="space-y-6" method="POST">
                <!-- Email -->
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="you@example.com"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition shadow-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition shadow-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="rounded text-pink-500 focus:ring-pink-500">
                        <span class="text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-pink-500 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-2xl font-semibold shadow-lg transition-transform transform hover:scale-105">
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-sm text-gray-500 mt-8">
                Don't have an account? <a href="#" class="text-pink-500 font-medium hover:underline">Sign up</a>
            </p>

        </div>
    </div>

</body>

</html>
