
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LembrePay') — Sua vida financeira organizada</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-layout">

        <aside class="sidebar">
            <div class="brand">
                <div class="brand-icon">L</div>
                <span>Lembre<span class="brand-highlight">Pay</span></span>
            </div>

            <div class="menu-label">MENU PRINCIPAL</div>

            <nav class="navigation">
                <a href="{{ route('dashboard') }}"
                   class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>◈</span> Dashboard
                </a>

                <a href="{{ route('bills.index') }}"
                   class="nav-item {{ request()->routeIs('bills.*') ? 'active' : '' }}">
                    <span>▤</span> Minhas contas
                </a>

                <a href="{{ route('recurrences.index') }}" class="nav-item">
                    <span>↻</span> Recorrências
                </a>

                <a href="#" class="nav-item">
                    <span>▦</span> Parcelamentos
                </a>

                <a href="#" class="nav-item">
                    <span>◷</span> Calendário
                </a>
            </nav>

            <div class="menu-label secondary-label">PREFERÊNCIAS</div>

            <nav class="navigation">
                <a href="{{ route('notifications.index') }}"
                   class="nav-item {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                    <span>♧</span> Notificações
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Conta pessoal</small>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="user-menu">↪</button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div>
                    <div class="breadcrumb">
                        LembrePay / @yield('breadcrumb', 'Dashboard')
                    </div>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>

                <a href="{{ route('notifications.index') }}"
                   class="notification-button">♧</a>
            </header>
@if (session('success'))
    <div class="alert alert-{{ session('alert_type', 'success') }} auto-dismiss">
        <span class="alert-icon">
            {{ session('alert_type') === 'warning' ? 'Ⅱ' : '✓' }}
        </span>

        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-error auto-dismiss">
        <span class="alert-icon">!</span>
        {{ $errors->first() }}
    </div>
@endif
            @yield('content')

            <footer class="footer">
                LembrePay © 2026 · Organização financeira simplificada.
            </footer>
        </main>
    </div>
</body>
</html>
