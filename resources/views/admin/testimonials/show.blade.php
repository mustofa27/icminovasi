@extends('layouts.admin')

@section('title', $testimonial->client_name . ' - Testimonial Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('admin.testimonials.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left"></i>
        Back to Testimonials
    </a>

    <h1 class="text-3xl font-bold text-gray-900 mb-8">Testimonial Details</h1>

    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $testimonial->client_name }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                    <p class="text-gray-700">{{ $testimonial->client_position ?? 'N/A' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Testimonial</label>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $testimonial->testimonial }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex gap-1">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-yellow-400 text-lg"></i>
                        @endfor
                        @for($i = $testimonial->rating; $i < 5; $i++)
                            <i class="fas fa-star text-gray-300 text-lg"></i>
                        @endfor
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                    <p class="text-gray-700">{{ $testimonial->project?->name ?? 'N/A' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    @if($testimonial->is_published)
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">Published</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">Draft</span>
                    @endif
                </div>
            </div>

            <div>
                @if($testimonial->client_photo)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client Photo</label>
                    <img src="{{ asset('storage/' . $testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-full rounded-lg object-cover">
                </div>
                @endif

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-3">Created: {{ $testimonial->created_at->format('M d, Y H:i') }}</p>
                    <p class="text-sm text-gray-600 mb-4">Updated: {{ $testimonial->updated_at->format('M d, Y H:i') }}</p>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition text-center font-medium text-sm">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-medium text-sm">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
