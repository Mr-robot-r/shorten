<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'My App')</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Additional styles -->
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">MyApp</a>
            <nav class="space-x-4">
                <a href="/" class="hover:text-indigo-500">Home</a>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-6">
        <div class="container mx-auto px-4 py-4 text-center text-gray-500">
            &copy; {{ date('Y') }} MyApp. All rights reserved.
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
