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

<body class="bg-gray-100 p-6">

    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Header -->
                <thead class="bg-indigo-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Password
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold text-white uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y divide-gray-100">
                    @auth
                        {{-- @php Auth::user() = Auth::guard('students')->user(); @endphp --}}
                        <tr class="bg-gray-50 hover:bg-gray-100 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Auth::user()->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Auth::user()->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Auth::user()->password }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                <a href="{{ route('edit.login', Auth::user()->id) }}"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition">Edit
                                </a>
                                <form action="{{ route('login.delete', Auth::user()->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                                <form action="{{ route('logout')}}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                                        Logout
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endauth
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
