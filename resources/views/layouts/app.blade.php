<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ICM Inovasi Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'ICM Inovasi Indonesia')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow,max-image-preview:large')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'ICM Inovasi Indonesia')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'ICM Inovasi Indonesia')))">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/favicon.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'ICM Inovasi Indonesia')))">
    <meta name="twitter:description" content="@yield('twitter_description', trim($__env->yieldContent('meta_description', 'ICM Inovasi Indonesia')))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/favicon.png'))">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-gray-100">
    @yield('content')
</body>
</html>
