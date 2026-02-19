@extends('layouts.master')

@section('title', '404 | Page Not Found')

@section('content')
    <div class="text-center py-20">
        <h1 class="text-8xl font-extrabold text-indigo-600">404</h1>

        <p class="text-2xl font-semibold mt-4">
            Oops! Page not found.
        </p>

        <p class="mt-2 text-gray-600">
            We can’t seem to find the page you’re looking for.
        </p>

        <a href="/"
            class="mt-6 inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
            Go Home
        </a>
    </div>
@endsection