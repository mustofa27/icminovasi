<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ICM Inovasi Indonesia - Informatics, Creative & Mechatronics')</title>
    <meta name="description" content="@yield('meta_description', 'ICM Inovasi Indonesia provides innovative solutions in Informatics, Creative, and Mechatronics.')">
    <meta name="facebook-domain-verification" content="jwj88ahn1vc3bee03cvltp1ueqy7oy" />
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
        }
        .nav-active {
            color: #6d28d9;
            background-color: #ede9fe;
            font-weight: 600;
            box-shadow: inset 0 -2px 0 0 #7c3aed;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ url('images/icm-logo.png') }}" alt="ICM Inovasi Indonesia" class="h-10 sm:h-12 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span class="hidden text-lg sm:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">ICM Inovasi</span>
                    </a>
                    <button id="nav-toggle" class="md:hidden text-gray-700 hover:text-purple-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="hidden md:flex space-x-1">
                        <a href="#services" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Services</a>
                        @if($featured_projects->count() > 0 || $all_projects->count() > 0)
                            <a href="#projects" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Projects</a>
                        @endif
                        @if($latest_articles->count() > 0)
                            <a href="#blog" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Blog</a>
                        @endif
                        @if($clients->count() > 0)
                            <a href="#clients" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Clients</a>
                        @endif
                        @if($testimonials->count() > 0)
                            <a href="#testimonials" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Testimonials</a>
                        @endif
                        <a href="#contact" class="text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition text-sm font-medium">Contact</a>
                    </div>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hidden md:block bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition text-sm font-medium">Admin</a>
                    @endauth
                </div>
                <div id="mobile-nav" class="hidden md:hidden pb-4 space-y-2 border-t">
                    <a href="#services" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Services</a>
                    @if($featured_projects->count() > 0 || $all_projects->count() > 0)
                        <a href="#projects" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Projects</a>
                    @endif
                    @if($latest_articles->count() > 0)
                        <a href="#blog" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Blog</a>
                    @endif
                    @if($clients->count() > 0)
                        <a href="#clients" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Clients</a>
                    @endif
                    @if($testimonials->count() > 0)
                        <a href="#testimonials" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Testimonials</a>
                    @endif
                    <a href="#contact" class="block text-gray-700 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md transition">Contact</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="block bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-md transition font-medium">Admin Panel</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-5xl font-bold mb-6">Welcome to ICM Inovasi Indonesia</h2>
                    <p class="text-xl mb-8 text-purple-100">
                        Innovation and excellence in Informatics, Creative, and Mechatronics solutions. We transform ideas into reality.
                    </p>
                    <div class="flex gap-4">
                        <a href="#projects" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-50 transition">
                            View Our Work
                        </a>
                        <a href="#contact" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition">
                            Get in Touch
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white bg-opacity-10 rounded-lg p-8 backdrop-blur">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="p-4">
                                <div class="text-4xl font-bold">{{ $stats['total_projects'] }}</div>
                                <div class="text-sm text-purple-200">Projects Completed</div>
                            </div>
                            <div class="p-4 border-l border-r border-purple-300">
                                <div class="text-4xl font-bold">{{ $stats['total_clients'] }}</div>
                                <div class="text-sm text-purple-200">Satisfied Clients</div>
                            </div>
                            <div class="p-4">
                                <div class="text-4xl font-bold">{{ $stats['expertise_areas'] }}</div>
                                <div class="text-sm text-purple-200">Expertise Areas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Our Expertise</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Informatics -->
                <div class="hover-scale bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-code text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Informatics</h3>
                    <p class="text-gray-600 mb-4">
                        Custom software development, web applications, mobile apps, and digital transformation solutions.
                    </p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Web Dev</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Mobile</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Cloud</span>
                    </div>
                </div>

                <!-- Creative -->
                <div class="hover-scale bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-palette text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Creative</h3>
                    <p class="text-gray-600 mb-4">
                        Graphic design, branding, UI/UX design, digital marketing, and content creation services.
                    </p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">Design</span>
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">Branding</span>
                        <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">Marketing</span>
                    </div>
                </div>

                <!-- Mechatronics -->
                <div class="hover-scale bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-microchip text-orange-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Mechatronics</h3>
                    <p class="text-gray-600 mb-4">
                        Robotics, automation, IoT solutions, embedded systems, and hardware integration.
                    </p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">Robotics</span>
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">IoT</span>
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">Automation</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    @if($featured_projects->count() > 0)
    <section id="projects" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8">
                <div class="text-center sm:text-left flex-1">
                    <h2 class="text-4xl font-bold mb-4">Featured Projects</h2>
                    <p class="text-gray-600 max-w-2xl">
                        Explore some of our most successful projects across all three areas of expertise.
                    </p>
                </div>
                <a href="{{ route('projects.index') }}" class="mt-4 sm:mt-0 text-purple-600 hover:text-purple-800 font-semibold">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featured_projects as $project)
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
                                <div class="flex flex-wrap gap-1">
                                    @foreach($project->expertise_areas as $expertise)
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ \App\Models\Project::expertiseBadgeClass($expertise) }}">
                                            {{ \App\Models\Project::expertiseLabel($expertise) }}
                                        </span>
                                    @endforeach
                                </div>
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
        </div>
    </section>
    @endif

    <!-- Recent Projects -->
    @if($all_projects->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Recent Projects</h2>
            <div class="space-y-6">
                @foreach($all_projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="block hover:shadow-lg transition">
                    <div class="bg-white rounded-lg shadow p-6 flex items-center gap-6">
                        @if($project->featured_image)
                            <div class="h-24 w-32 flex-shrink-0 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl font-bold">{{ $project->name }}</h3>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($project->expertise_areas as $expertise)
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ \App\Models\Project::expertiseBadgeClass($expertise) }}">
                                            {{ \App\Models\Project::expertiseLabel($expertise) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-gray-600">{{ Str::limit(strip_tags($project->description), 120) }}</div>
                            <div class="flex gap-4 mt-3 text-sm text-gray-500">
                                <span><strong>Client:</strong> {{ $project->client?->name ?? 'N/A' }}</span>
                                <span><strong>Duration:</strong> {{ $project->start_date->format('M Y') }} - {{ $project->end_date?->format('M Y') ?? 'Present' }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest Blog Section -->
    @if($latest_articles->count() > 0)
    <section id="blog" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12">
                <div>
                    <h2 class="text-4xl font-bold mb-3">Latest Articles</h2>
                    <p class="text-gray-600">Insights and updates from our team.</p>
                </div>
                <a href="{{ route('articles.index') }}" class="mt-4 sm:mt-0 text-purple-600 hover:text-purple-800 font-semibold">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latest_articles as $article)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition hover-scale group">
                    @if($article->featured_image)
                        <div class="h-48 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3 text-sm text-gray-500">
                            <span>{{ $article->published_at?->format('M d, Y') }}</span>
                            <span>•</span>
                            <span>{{ $article->user?->name ?? 'ICM Inovasi' }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article) }}">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-purple-600 transition">{{ $article->title }}</h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex gap-4">
                                <span><i class="fas fa-eye mr-1"></i> {{ $article->views_count }}</span>
                                <span><i class="fas fa-heart mr-1"></i> {{ $article->likes_count }}</span>
                                <span><i class="fas fa-comment mr-1"></i> {{ $article->comments_count }}</span>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Clients Section -->
    @if($clients->count() > 0)
    <section id="clients" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-12">
                <h2 class="text-4xl font-bold text-center sm:text-left">Our Clients</h2>
                <a href="{{ route('clients.index') }}" class="mt-4 sm:mt-0 text-purple-600 hover:text-purple-800 font-semibold text-center sm:text-left">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($clients as $client)
                <div class="bg-gray-50 rounded-lg p-8 flex flex-col items-center justify-center hover:shadow-lg transition">
                    @if($client->logo)
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="h-16 mb-4 object-contain">
                    @endif
                    <h4 class="font-semibold text-center text-gray-900">{{ $client->name }}</h4>
                    <p class="text-xs text-gray-500 text-center mt-2">{{ $client->projects_count }} project(s)</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section id="testimonials" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-12">
                <h2 class="text-4xl font-bold text-center sm:text-left">What Clients Say</h2>
                <a href="{{ route('testimonials.index') }}" class="mt-4 sm:mt-0 text-purple-600 hover:text-purple-800 font-semibold text-center sm:text-left">
                    View All <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-600">
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
    </section>
    @endif

    <!-- Contact Form Section -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-4">Send Us a Message</h2>
                <p class="text-gray-600">Tell us about your project and we’ll get back to you.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('inquiries.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="whatsapp_number" class="block text-sm font-medium text-gray-700">WhatsApp Number *</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number') }}" required
                               placeholder="6281234567890"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                        @error('whatsapp_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email (optional)</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                    @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="mt-6">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message *</label>
                    <textarea name="message" id="message" rows="5" required
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">{{ old('message') }}</textarea>
                    @error('message')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Start Your Project?</h2>
            <p class="text-xl mb-8 text-purple-100">
                Let's discuss how we can help you achieve your business goals with innovative solutions.
            </p>
            @php
                $messageTemplate = $settings->message_template ?? 'Hello I am interested to use your service for my project';
                $waNumber = $settings->whatsapp_number ?? '6281279881542';
                $emailDestination = $settings->email_destination ?? 'icminovasi@gmail.com';
                $encodedMessage = rawurlencode($messageTemplate);
                $encodedSubject = rawurlencode('Service Inquiry');
            @endphp
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:{{ $emailDestination }}?subject={{ $encodedSubject }}&body={{ $encodedMessage }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-50 transition inline-block">
                    <i class="fas fa-envelope mr-2"></i>Email Us
                </a>
                <a href="https://wa.me/{{ $waNumber }}?text={{ $encodedMessage }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition inline-block">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">ICM Inovasi</h3>
                    <p class="text-sm">Innovation in Informatics, Creative & Mechatronics</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#services" class="hover:text-white transition">Informatics</a></li>
                        <li><a href="#services" class="hover:text-white transition">Creative</a></li>
                        <li><a href="#services" class="hover:text-white transition">Mechatronics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#projects" class="hover:text-white transition">Projects</a></li>
                        <li><a href="#clients" class="hover:text-white transition">Clients</a></li>
                        <li><a href="#contact" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Connect</h4>
                    <div class="flex gap-4">
                        @php
                            $socialLinks = $settings->social_links ?? [];
                        @endphp
                        @if(!empty($socialLinks['facebook']))
                            <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="text-gray-400 hover:text-white transition text-lg"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(!empty($socialLinks['twitter']))
                            <a href="{{ $socialLinks['twitter'] }}" target="_blank" class="text-gray-400 hover:text-white transition text-lg"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if(!empty($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" class="text-gray-400 hover:text-white transition text-lg"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($socialLinks['linkedin']))
                            <a href="{{ $socialLinks['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-white transition text-lg"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if(!empty($socialLinks['youtube']))
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank" class="text-gray-400 hover:text-white transition text-lg"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; 2026 ICM Inovasi Indonesia. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('content')

    <script>
        document.getElementById('nav-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-nav');
            menu.classList.toggle('hidden');
        });

        const navLinks = Array.from(document.querySelectorAll('nav a[href^="#"]'));
        const sections = Array.from(document.querySelectorAll('section[id]'));

        function setActiveLink(id) {
            navLinks.forEach(link => {
                const isActive = link.getAttribute('href') === `#${id}`;
                link.classList.toggle('nav-active', isActive);
            });
        }

        function updateActiveOnScroll() {
            const offset = 120;
            const scrollPos = window.scrollY + offset;
            let currentSection = sections[0];

            sections.forEach(section => {
                if (section.offsetTop <= scrollPos) {
                    currentSection = section;
                }
            });

            if (currentSection) {
                setActiveLink(currentSection.id);
            }
        }

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const targetId = link.getAttribute('href').replace('#', '');
                if (targetId) {
                    setActiveLink(targetId);
                }
            });
        });

        if (sections.length > 0) {
            updateActiveOnScroll();
            window.addEventListener('scroll', updateActiveOnScroll, { passive: true });
        }
    </script>
</body>
</html>
