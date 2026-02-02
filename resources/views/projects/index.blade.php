@extends('layouts.blog')

@section('title', 'All Projects - ICM Inovasi Indonesia')
@section('meta_description', 'Browse all our projects in Informatics, Creative, and Mechatronics')

@section('content')
<div class="bg-gradient-to-br from-purple-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Our Projects</h1>
        <p class="text-purple-100 text-lg">Explore our portfolio across Informatics, Creative, and Mechatronics</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($projects->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="hover-scale group">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full">
                        @if($project->featured_image)
                            <div class="h-48 overflow-hidden bg-gray-200">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                <i class="fas fa-image text-white text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold px-2 py-1 rounded-full
                                    @if($project->area_of_expertise === 'informatics') bg-blue-100 text-blue-800
                                    @elseif($project->area_of_expertise === 'creative') bg-pink-100 text-pink-800
                                    @else bg-orange-100 text-orange-800
                                    @endif">
                                    {{ ucfirst($project->area_of_expertise) }}
                                </span>
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 group-hover:text-purple-600 transition">{{ $project->name }}</h3>
                            <div class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($project->description), 120) }}</div>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>{{ $project->client?->name ?? 'Client' }}</span>
                                <span>{{ $project->start_date->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-folder-open text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-500 text-lg">No projects available</p>
        </div>
    @endif
</div>
@endsection
