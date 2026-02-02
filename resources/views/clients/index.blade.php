@extends('layouts.blog')

@section('title', 'Our Clients - ICM Inovasi Indonesia')
@section('meta_description', 'Our valued clients who trust us with their projects')

@section('content')
<div class="bg-gradient-to-br from-purple-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Our Clients</h1>
        <p class="text-purple-100 text-lg">Trusted partners across various industries</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($clients->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($clients as $client)
                <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col items-center justify-center hover:shadow-xl transition hover-scale">
                    @if($client->logo)
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="h-20 mb-4 object-contain">
                    @else
                        <div class="h-20 w-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                    @endif
                    <h4 class="font-semibold text-center text-gray-900 mb-2">{{ $client->name }}</h4>
                    @if($client->industry)
                        <p class="text-xs text-gray-600 text-center mb-2">{{ $client->industry }}</p>
                    @endif
                    <p class="text-xs text-purple-600 font-semibold text-center">{{ $client->projects_count }} project(s)</p>
                    @if($client->website)
                        <a href="{{ $client->website }}" target="_blank" class="text-xs text-gray-500 hover:text-purple-600 mt-2">
                            <i class="fas fa-external-link-alt mr-1"></i> Visit Website
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $clients->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-users text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg">No clients listed</p>
        </div>
    @endif
</div>
@endsection
