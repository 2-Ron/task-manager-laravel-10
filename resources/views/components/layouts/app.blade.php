<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'TodoMatrix' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="/" class="flex items-center">
                            <span class="text-xl font-bold text-gray-800">TodoMatrix</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <a href="/tasks" class="text-gray-600 hover:text-gray-900 px-3 py-2">Tasks</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-900 px-3 py-2">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            {{ $slot }}
        </main>
    </div>
</body>
</html>