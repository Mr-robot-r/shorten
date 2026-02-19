@extends('layouts.master')
@section('title', 'Url List')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Url List</h1>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="text-left">
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">ID
                    </th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        original_url</th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        short_code</th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        status</th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        clicks</th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        Created At</th>
                    <th class="py-3 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-300">
                        action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($urls as $url)
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->id }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->original_url }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->short_code }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->status }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->click }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">{{ $url->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-4 border-b border-gray-300">
                            <div class="flex items-center space-x-2">

                                <!-- Show -->
                                <a href="{{ route('urls.show', $url->id) }}"
                                    class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                    Show
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('urls.destroy', $url->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this URL?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No urls found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $urls->links('pagination::tailwind') }}
    </div>
@endsection