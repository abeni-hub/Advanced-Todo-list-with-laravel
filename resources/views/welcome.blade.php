<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light text-dark d-flex align-items-center justify-content-center min-vh-100 flex-column p-4">

    <header class="w-100 mb-4" style="max-width: 960px;">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark btn-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="container">
        <main class="row g-0 justify-content-center align-items-stretch">
            <div class="col-lg-8 bg-white p-4 shadow rounded-start">
                <h1 class="mb-3 fw-semibold">Let's get started</h1>
                <p class="text-muted mb-4">Laravel has an incredibly rich ecosystem. <br>We suggest starting with the following.</p>

                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex align-items-center">
                        <span class="me-3 text-primary">
                            <i class="bi bi-book"></i>
                        </span>
                        <span>
                            Read the
                            <a href="https://laravel.com/docs" target="_blank" class="text-decoration-underline text-danger ms-1">
                                Documentation
                            </a>
                        </span>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <span class="me-3 text-primary">
                            <i class="bi bi-camera-video"></i>
                        </span>
                        <span>
                            Watch video tutorials at
                            <a href="https://laracasts.com" target="_blank" class="text-decoration-underline text-danger ms-1">
                                Laracasts
                            </a>
                        </span>
                    </li>
                </ul>

                <a href="https://cloud.laravel.com" target="_blank" class="btn btn-dark">
                    Deploy now
                </a>
            </div>

            <div class="col-lg-4 bg-danger bg-opacity-10 rounded-end d-flex align-items-center justify-content-center">
                <!-- Logo or image goes here -->
                <img src="/logo.svg" alt="Laravel Logo" class="img-fluid p-4" />
            </div>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="mt-4 d-none d-lg-block" style="height: 60px;"></div>
    @endif

</body>
</html>