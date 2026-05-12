<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salon Prime')</title>
    <!-- All local — no internet required -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightweight-themes.css') }}">
    <style>
        *{box-sizing:border-box}
        body{-webkit-font-smoothing:antialiased;margin:0}
        img{max-width:100%;height:auto}

        /* Floating Dashboard Button */
        .float-dashboard {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            background: linear-gradient(135deg, #dc2626, #1e40af);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.7rem 1.25rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transition: all 0.2s;
            letter-spacing: 0.03em;
        }
        .float-dashboard:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.4);
            color: white;
            text-decoration: none;
        }
        .float-dashboard i { font-size: 0.9rem; }
    </style>
</head>
<body>
    @yield('content')

    @auth
    @php $dashRoute = auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard'); @endphp
    {{-- Hide on dashboard pages themselves --}}
    @if(!request()->routeIs('admin.dashboard') && !request()->routeIs('user.dashboard'))
    <a href="{{ $dashRoute }}" class="float-dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    @endif
    @endauth

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
