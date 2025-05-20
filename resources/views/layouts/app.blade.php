<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tabler + Laravel</title>

    {{-- Tabler CSS (CDN) --}}
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />
</head>

<body class="">

    <div class="page">
        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Content -->
        <div class="page-wrapper">
            <div class="container mt-5">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Tabler JS (CDN) --}}
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>

</html>
