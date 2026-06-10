<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ICM Inovasi Indonesia - Blog')</title>
    <meta name="description" content="@yield('meta_description', 'Read our latest articles and insights.')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow,max-image-preview:large')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'ICM Inovasi Indonesia - Blog')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Read our latest articles and insights.')))">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/favicon.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'ICM Inovasi Indonesia - Blog')))">
    <meta name="twitter:description" content="@yield('twitter_description', trim($__env->yieldContent('meta_description', 'Read our latest articles and insights.')))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/favicon.png'))">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ route('sitemap') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    <!-- Simple Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ url('images/icm-logo.png') }}" alt="ICM Inovasi Indonesia" class="h-10 sm:h-12 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span class="hidden text-lg sm:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">ICM Inovasi</span>
                    </a>
                    <div class="flex items-center gap-4">
                        <a href="{{ url('/') }}" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                        <a href="{{ route('projects.index') }}" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition text-sm font-medium">
                            <i class="fas fa-briefcase mr-1"></i> Projects
                        </a>
                        <a href="{{ route('articles.index') }}" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition text-sm font-medium">
                            <i class="fas fa-blog mr-1"></i> Blog
                        </a>
                        <a href="{{ route('clients.index') }}" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition text-sm font-medium">
                            <i class="fas fa-users mr-1"></i> Clients
                        </a>
                        <a href="{{ route('testimonials.index') }}" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md transition text-sm font-medium">
                            <i class="fas fa-comment-dots mr-1"></i> Testimonials
                        </a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition text-sm font-medium">
                                <i class="fas fa-cog mr-1"></i> Admin
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <script>
        (function () {
            const links = document.querySelectorAll('.nav-link');
            const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

            links.forEach(link => {
                const linkPath = new URL(link.href).pathname.replace(/\/+$/, '') || '/';
                if (linkPath === currentPath) {
                    link.classList.add('nav-active');
                }
            });
        })();
    </script>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">ICM Inovasi Indonesia</h3>
                    <p class="text-gray-400 mb-4">
                        Innovation and excellence in Informatics, Creative, and Mechatronics solutions.
                    </p>
                    <div class="flex gap-4">
                        @php
                            $socialLinks = isset($settings) ? ($settings->social_links ?? []) : [];
                        @endphp
                        @if(!empty($socialLinks['facebook']))
                            <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook text-xl"></i></a>
                        @endif
                        @if(!empty($socialLinks['twitter']))
                            <a href="{{ $socialLinks['twitter'] }}" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                        @endif
                        @if(!empty($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram text-xl"></i></a>
                        @endif
                        @if(!empty($socialLinks['linkedin']))
                            <a href="{{ $socialLinks['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin text-xl"></i></a>
                        @endif
                        @if(!empty($socialLinks['youtube']))
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube text-xl"></i></a>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ url('/#services') }}" class="hover:text-white transition">Services</a></li>
                        <li><a href="{{ url('/#projects') }}" class="hover:text-white transition">Projects</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><i class="fas fa-envelope mr-2"></i> {{ isset($settings) ? ($settings->contact_email ?? 'info@icminovasi.com') : 'info@icminovasi.com' }}</li>
                        <li><i class="fas fa-phone mr-2"></i> {{ isset($settings) ? ($settings->whatsapp_number ?? '+62 xxx xxxx xxxx') : '+62 xxx xxxx xxxx' }}</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ICM Inovasi Indonesia. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
