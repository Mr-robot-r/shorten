@extends('layouts.master')

@section('title', 'URL Details')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">URL Details</h1>

        <div class="space-y-4">

            {{-- Original URL --}}
            <div>
                <p class="text-sm text-gray-500">Original URL</p>
                <a href="{{ $url->original_url }}" target="_blank" class="text-indigo-600 hover:underline break-all">
                    {{ $url->original_url }}
                </a>
            </div>

            {{-- Short URL --}}
            <div>
                <p class="text-sm text-gray-500">Short URL</p>
                <div class="flex items-center gap-3">
                    <a href="{{ url($url->short_code) }}" target="_blank"
                        class="text-green-600 font-semibold hover:underline">
                        {{ url($url->short_code) }}
                    </a>

                    <button onclick="navigator.clipboard.writeText('{{ url($url->short_code) }}')"
                        class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                        Copy
                    </button>
                </div>
            </div>

            {{-- Created At --}}
            <div>
                <p class="text-sm text-gray-500">Created At</p>
                <p class="font-medium">{{ $url->created_at }}</p>
            </div>

        </div>

        <div class="mt-8">
            <a href="{{ route('urlpanel.index') }}"
                class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Back to List
            </a>
        </div>

    </div>
@endsection