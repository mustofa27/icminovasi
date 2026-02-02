<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ICM Inovasi Indonesia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-gray-100">
    @yield('content')
</body>
</html>
