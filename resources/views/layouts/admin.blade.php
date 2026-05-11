<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Skills LABS Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-sl-bg text-sl-text min-h-screen flex">

    {{-- ─── SIDEBAR ─── --}}
    <aside class="w-60 bg-sl-surface border-r border-sl-border min-h-screen flex flex-col fixed left-0 top-0 z-40">
        {{-- Logo --}}
        <div class="p-4 border-b border-sl-border">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-sl-red rounded-lg flex items-center justify-center shadow-glow-red">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <div class="font-display font-extrabold text-sl-text text-sm">Skills<span class="text-sl-red">LABS</span></div>
                    <div class="text-xs text-sl-text-muted">Admin Panel</div>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 space-y-0.5">
            <p class="text-sl-text-muted text-xs font-semibold uppercase tracking-widest px-3 py-2">Menu Utama</p>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.labs.index') }}" class="sidebar-item {{ request()->routeIs('admin.labs.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Manajemen Labs
            </a>
            <a href="{{ route('admin.students.index') }}" class="sidebar-item {{ request()->routeIs('admin.students.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Mahasiswa
            </a>
            <div class="border-t border-sl-border my-2"></div>
            <a href="{{ route('home') }}" class="sidebar-item">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
        </nav>

        {{-- User --}}
        <div class="p-3 border-t border-sl-border">
            <div class="flex items-center gap-2 mb-2">
                <img src="{{ auth()->user()?->avatar_url }}" alt="" class="w-8 h-8 rounded-full border border-sl-border">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-sl-text truncate">{{ auth()->user()?->name }}</p>
                    <p class="text-xs text-sl-red">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-xs text-sl-text-muted hover:text-sl-red transition-colors w-full text-left py-1 flex items-center gap-1.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar dari akun
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── MAIN ─── --}}
    <div class="ml-60 flex-1 flex flex-col min-h-screen">
        {{-- Header --}}
        <header class="bg-sl-surface border-b border-sl-border px-6 py-4 sticky top-0 z-30 flex items-center justify-between">
            <div>
                <h1 class="text-base font-bold text-sl-text">@yield('page-title', 'Admin Panel')</h1>
                <p class="text-xs text-sl-text-muted font-mono">{{ now()->format('l, d M Y') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="status-online"></span>
                <span class="text-xs text-sl-green-2 font-mono">System Online</span>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mx-6 mt-4"><div class="alert-success">{{ session('success') }}</div></div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4"><div class="alert-error">{{ session('error') }}</div></div>
        @endif

        <main class="flex-1 p-6">@yield('content')</main>
    </div>

    @stack('scripts')
</body>
</html>
