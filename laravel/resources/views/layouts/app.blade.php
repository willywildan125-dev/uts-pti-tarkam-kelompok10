<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tarkam Bola')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-success mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">⚽ Tarkam Bola</a>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="text-white small me-2 d-none d-sm-inline">
                        {{ auth()->user()->Nama_user }} ({{ ucfirst(auth()->user()->role) }})
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="btn btn-sm btn-light">Logout</button>
                    </form>
                @else
                    @if (!request()->routeIs('login'))
                        <a href="{{ route('login') }}" class="btn btn-sm btn-light">Login</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>
</body>
</html>
