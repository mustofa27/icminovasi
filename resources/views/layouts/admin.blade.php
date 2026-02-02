<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - ICM Inovasi Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-4">
                    <button id="menu-btn" class="sm:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ url('images/icm-logo.png') }}" alt="ICM Inovasi Indonesia" class="h-8 sm:h-10 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span class="text-lg sm:text-xl font-bold text-gray-800">ICM Inovasi</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:space-x-1">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Projects
                    </a>
                    <a href="{{ route('admin.clients.index') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Clients
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Testimonials
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Inquiries
                    </a>
                    <a href="{{ route('admin.settings.edit') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Settings
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                        Users
                    </a>
                    @endif
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <span class="hidden sm:inline text-gray-700 text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden sm:hidden pb-3 space-y-1">
                <p class="text-gray-600 px-3 py-2 text-xs font-medium uppercase">{{ auth()->user()->name }}</p>
                <a href="{{ route('admin.dashboard') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Projects
                </a>
                <a href="{{ route('admin.clients.index') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Clients
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Testimonials
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Inquiries
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Settings
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="block text-gray-600 hover:text-purple-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium transition">
                    Users
                </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="max-w-7xl mx-auto">
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
        @endif

            @yield('content')
        </div>
    </main>

    <script>
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
