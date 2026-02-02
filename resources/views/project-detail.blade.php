@extends('layouts.app')

@section('title', $project->name . ' - ICM Inovasi Indonesia')

@section('meta_description', $project->short_description)

@section('content')
<!-- Hero Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-800 flex items-center gap-2 mb-6">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
        <h1 class="text-5xl font-bold mb-4">{{ $project->name }}</h1>
        <div class="flex flex-wrap gap-4 items-center">
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                @if($project->area_of_expertise === 'informatics') bg-blue-100 text-blue-800
                @elseif($project->area_of_expertise === 'creative') bg-pink-100 text-pink-800
                @else bg-orange-100 text-orange-800
                @endif">
                {{ ucfirst($project->area_of_expertise) }}
            </span>
            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                {{ ucfirst($project->status) }}
            </span>
            <span class="text-gray-600">
                <strong>Client:</strong> {{ $project->client?->name ?? 'N/A' }}
            </span>
        </div>
    </div>
</section>

<!-- Project Details -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                @if($project->featured_image)
                <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->name }}" class="w-full h-96 object-cover">
                </div>
                @endif

                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <h2 class="text-3xl font-bold mb-4">Project Overview</h2>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $project->description }}</p>
                    </div>
                </div>

                @if($project->challenges)
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-4">Challenges</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $project->challenges }}</p>
                </div>
                @endif

                @if($project->solutions)
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-4">Solutions</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $project->solutions }}</p>
                </div>
                @endif

                @if($project->results)
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-4">Results</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $project->results }}</p>
                </div>
                @endif

                <!-- Testimonials -->
                @if($project->testimonials->count() > 0)
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-6">Client Testimonials</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($project->testimonials->where('is_published', true) as $testimonial)
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg shadow-lg p-6 border-l-4 border-purple-600">
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
                            <p class="text-gray-700 italic mb-4">"{{ $testimonial->testimonial }}"</p>
                            <div class="flex items-center gap-3">
                                @if($testimonial->client_photo)
                                    <img src="{{ asset('storage/' . $testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-10 h-10 rounded-full object-cover">
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $testimonial->client_name }}</p>
                                    @if($testimonial->client_position)
                                        <p class="text-sm text-gray-600">{{ $testimonial->client_position }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Project Info Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 top-16 max-h-[calc(100vh-80px)] overflow-y-auto z-10">
                    <h3 class="text-xl font-bold mb-4">Project Information</h3>
                    
                    <div class="space-y-4">
                        <div class="pb-4 border-b">
                            <p class="text-sm text-gray-600 font-semibold">Client</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $project->client?->name ?? 'N/A' }}</p>
                        </div>

                        <div class="pb-4 border-b">
                            <p class="text-sm text-gray-600 font-semibold">Expertise</p>
                            <p class="text-lg font-semibold text-gray-900">{{ ucfirst($project->area_of_expertise) }}</p>
                        </div>

                        <div class="pb-4 border-b">
                            <p class="text-sm text-gray-600 font-semibold">Status</p>
                            <p class="text-lg font-semibold text-gray-900">{{ ucfirst($project->status) }}</p>
                        </div>

                        <div class="pb-4 border-b">
                            <p class="text-sm text-gray-600 font-semibold">Duration</p>
                            <p class="text-gray-900">
                                {{ $project->start_date->format('M d, Y') }}
                                <br>
                                @if($project->end_date)
                                    to {{ $project->end_date->format('M d, Y') }}
                                @else
                                    to Present
                                @endif
                            </p>
                        </div>

                        @if($project->team_size)
                        <div class="pb-4 border-b">
                            <p class="text-sm text-gray-600 font-semibold">Team Size</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $project->team_size }} people</p>
                        </div>
                        @endif

                        @if($project->technologies_used && is_array($project->technologies_used) && count($project->technologies_used) > 0)
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Technologies</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->technologies_used as $tech)
                                    <span class="bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="w-full mt-6 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg text-center block transition">
                        <i class="fas fa-external-link-alt mr-2"></i>Visit Live Project
                    </a>
                    @endif
                </div>

                <!-- Client Info Card -->
                @if($project->client)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">About the Client</h3>
                    
                    @if($project->client->logo)
                    <div class="mb-4 flex justify-center">
                        <img src="{{ asset('storage/' . $project->client->logo) }}" alt="{{ $project->client->name }}" class="h-16 object-contain">
                    </div>
                    @endif

                    <h4 class="font-semibold text-gray-900 mb-2">{{ $project->client->name }}</h4>
                    
                    @if($project->client->company_name)
                    <p class="text-sm text-gray-600 mb-3">{{ $project->client->company_name }}</p>
                    @endif

                    @if($project->client->description)
                    <p class="text-gray-700 text-sm mb-4">{{ $project->client->description }}</p>
                    @endif

                    <div class="space-y-2 text-sm">
                        @if($project->client->email)
                        <p><strong>Email:</strong> <a href="mailto:{{ $project->client->email }}" class="text-purple-600 hover:text-purple-800">{{ $project->client->email }}</a></p>
                        @endif
                        @if($project->client->phone)
                        <p><strong>Phone:</strong> {{ $project->client->phone }}</p>
                        @endif
                        @if($project->client->website)
                        <p><strong>Website:</strong> <a href="{{ $project->client->website }}" target="_blank" class="text-purple-600 hover:text-purple-800">Visit</a></p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($related_projects->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8">Related Projects</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($related_projects as $related)
            <a href="{{ route('projects.show', $related) }}" class="group">
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    @if($related->featured_image)
                        <div class="h-40 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        </div>
                    @else
                        <div class="h-40 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                            <i class="fas fa-image text-white text-3xl"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition">{{ $related->name }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ $related->short_description }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Interested in Similar Solutions?</h2>
        <p class="text-lg mb-8 text-purple-100">Let's discuss how we can help your business achieve similar results.</p>
        @php
            $messageTemplate = $settings->message_template ?? 'Hello I am interested to use your service for my project';
            $emailDestination = $settings->email_destination ?? 'icminovasi@gmail.com';
            $encodedMessage = rawurlencode($messageTemplate);
            $encodedSubject = rawurlencode('Service Inquiry');
        @endphp
        <a href="mailto:{{ $emailDestination }}?subject={{ $encodedSubject }}&body={{ $encodedMessage }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-50 transition">
            <i class="fas fa-envelope mr-2"></i>Contact Us
        </a>
    </div>
</section>
@endsection
