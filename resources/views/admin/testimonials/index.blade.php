@extends('layouts.admin')

@section('title', 'Testimonials - Admin Panel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Add Testimonial
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($testimonials->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Client Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($testimonials as $testimonial)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $testimonial->client_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $testimonial->project?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex gap-1">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star text-yellow-400"></i>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($testimonial->is_published)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Published</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2 flex">
                        <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $testimonials->links() }}
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-8 text-center">
        <i class="fas fa-comments text-4xl text-gray-300 mb-4 block"></i>
        <p class="text-gray-600">No testimonials yet.</p>
    </div>
    @endif
</div>
@endsection
