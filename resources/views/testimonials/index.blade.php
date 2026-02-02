@extends('layouts.blog')

@section('title', 'Client Testimonials - ICM Inovasi Indonesia')
@section('meta_description', 'Read what our clients say about working with us')

@section('content')
<div class="bg-gradient-to-br from-purple-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Client Testimonials</h1>
        <p class="text-purple-100 text-lg">See what our clients say about working with us</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($testimonials->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-600 hover:shadow-xl transition hover-scale">
                    @if($testimonial->rating)
                    <div class="flex gap-1 mb-3">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star text-yellow-400"></i>
                        @endfor
                        @for($i = $testimonial->rating; $i < 5; $i++)
                            <i class="fas fa-star text-gray-300"></i>
                        @endfor
                    </div>
                    @endif
                    <p class="text-gray-700 italic mb-6">"{{ $testimonial->testimonial }}"</p>
                    <div class="flex items-center gap-3">
                        @if($testimonial->client_photo)
                            <img src="{{ asset('storage/' . $testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-900">{{ $testimonial->client_name }}</p>
                            @if($testimonial->client_position)
                                <p class="text-sm text-gray-600">{{ $testimonial->client_position }}</p>
                            @endif
                            @if($testimonial->client_company)
                                <p class="text-xs text-gray-500">{{ $testimonial->client_company }}</p>
                            @endif
                        </div>
                    </div>
                    @if($testimonial->created_at)
                        <p class="text-xs text-gray-400 mt-4">{{ $testimonial->created_at->format('M d, Y') }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $testimonials->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-comments text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg">No testimonials available</p>
        </div>
    @endif
</div>
@endsection
