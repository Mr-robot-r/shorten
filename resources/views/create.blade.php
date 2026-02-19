@extends('layouts.master')

@section('title', 'Create Short URL')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">Create Short URL</h1>

        <form action="{{ route('urlpanel.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Original URL --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Original URL
                </label>
                <input type="url" name="original_url" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="https://example.com">
                @error('original_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Generate Short URL
                </button>
            </div>

        </form>
    </div>
@endsection