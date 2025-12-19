<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- 
    This is a Laravel Blade template for editing a login record.
    Blade is Laravel's templating engine that allows us to use PHP code directly in HTML.
    {{-- {{ }} is used to echo (print) variables --}}
    @directive is used for Blade control structures
-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- config('app.name', 'Laravel') gets the app name from config/app.php, defaults to 'Laravel' -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        <!-- Vite is a build tool. This checks if Vite is running and loads CSS/JS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <!-- Main container with dark background and centered layout -->
    <div class="flex min-h-screen flex-col justify-center bg-black px-6 py-12 lg:px-8">
        <!-- Header section with logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company"
                class="mx-auto h-10 w-auto" />
            <!-- Page title -->
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Edit Login</h2>
        </div>

        <!-- Form container -->
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('edit.login', $student->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- EMAIL FIELD -->
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" value="{{ $student->email }}" required autocomplete="email"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD FIELD -->
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 flex justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Update
                    </button>
                    <a href="/list"
                        class="flex-1 flex justify-center rounded-md bg-gray-600 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>