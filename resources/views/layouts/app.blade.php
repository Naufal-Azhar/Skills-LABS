<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Skills LABS') — Hands-On Learning ITEBA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-sl-bg text-sl-text min-h-screen flex flex-col">

    {{-- ─── NAVBAR ─── --}}
    <nav id="navbar" class="bg-sl-surface border-b border-sl-border sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-sl-red rounded-lg flex items-center justify-center shadow-glow-red group-hover:shadow-glow-red-lg transition-all duration-200">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="leading-none">
                        <div class="font-display font-extrabold text-sl-text text-base tracking-tight">
                            Skills<span class="text-sl-red">LABS</span>
                        </div>
                        <div class="text-sl-text-muted text-xs font-mono">by ITEBA</div>
                    </div>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center gap-6">
                    @guest
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Home</a>
                    @endguest
                    @auth
                        <a href="{{ route('labs.index') }}" class="nav-link {{ request()->routeIs('labs.*') ? 'nav-link-active' : '' }}">Labs</a>
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'nav-link-active' : '' }}">Admin</a>
                        @endif
                    @endauth
                </div>

                {{-- Right Side --}}
                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary text-xs px-4 py-2">
                            Daftar Gratis
                        </a>
                    @else
                        {{-- Progress Icon --}}
                        <a href="{{ route('my.progress') }}" class="text-sl-text-muted hover:text-sl-red transition-colors" title="Progress saya">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </a>
                        {{-- User Dropdown (Alpine.js — click to open, click outside to close) --}}
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open"
                                    class="flex items-center gap-2 focus:outline-none"
                                    :class="open ? 'opacity-100' : ''">
                                <div class="relative">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="Avatar"
                                         class="w-8 h-8 rounded-full border-2 transition-colors"
                                         :class="open ? 'border-sl-red' : 'border-sl-border'">
                                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-sl-green-2 rounded-full border-2 border-sl-surface"></span>
                                </div>
                                <span class="hidden md:block text-sm font-medium text-sl-text max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                                <svg class="w-3 h-3 text-sl-text-muted transition-transform duration-200"
                                     :class="open ? 'rotate-180' : ''"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            {{-- Dropdown panel --}}
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                 class="absolute right-0 mt-2 w-52 bg-sl-surface border border-sl-border rounded-xl shadow-card-dark py-1 z-50"
                                 style="display:none">
                                <div class="px-4 py-3 border-b border-sl-border">
                                    <p class="text-sm font-bold text-sl-text truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-sl-text-muted font-mono">{{ auth()->user()->nim }}</p>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <span class="status-online"></span>
                                        <span class="text-xs text-sl-green-2">Online</span>
                                    </div>
                                </div>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-sl-text-2 hover:bg-sl-card hover:text-sl-text transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('my.progress') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-sl-text-2 hover:bg-sl-card hover:text-sl-text transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    Progress Saya
                                </a>
                                <a href="{{ route('certificates.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-sl-text-2 hover:bg-sl-card hover:text-sl-text transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    Sertifikat
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-sl-text-2 hover:bg-sl-card hover:text-sl-text transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil
                                </a>
                                <div class="border-t border-sl-border mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2.5 text-sm text-sl-red hover:bg-sl-red-dim transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 pt-4 w-full">
            <div class="alert-success animate-fade-in-up">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 pt-4 w-full">
            <div class="alert-error animate-fade-in-up">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main --}}
    <main class="flex-1">@yield('content')</main>

    {{-- ─── FOOTER ─── --}}
    <footer class="bg-sl-surface border-t border-sl-border mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-7 h-7 bg-sl-red rounded-lg flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                        <span class="font-display font-extrabold text-sl-text">Skills<span class="text-sl-red">LABS</span></span>
                    </div>
                    <p class="text-sm text-sl-text-2 leading-relaxed">Platform hands-on learning untuk mahasiswa ITEBA. Belajar praktik, upgrade skill — <span class="text-sl-green-2 font-semibold">gratis!</span></p>
                </div>
                <div>
                    <h4 class="text-sl-text font-semibold mb-3 text-sm">Navigation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-sl-text-2 hover:text-sl-red transition-colors">Home</a></li>
                        <li><a href="{{ route('labs.index') }}" class="text-sl-text-2 hover:text-sl-red transition-colors">Katalog Labs</a></li>
                        <li><a href="{{ route('register') }}" class="text-sl-text-2 hover:text-sl-red transition-colors">Daftar Sekarang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sl-text font-semibold mb-3 text-sm">ITEBA</h4>
                    <p class="text-sm text-sl-text-2">Institut Teknologi Batam<br>Batam, Kepulauan Riau</p>
                    <p class="text-xs text-sl-text-muted mt-2">Skills LABS — fasilitas digital yang sudah termasuk dalam UKT mahasiswa ITEBA.</p>
                </div>
            </div>
            <div class="border-t border-sl-border pt-6 flex flex-col md:flex-row items-center justify-between gap-2">
                <p class="text-xs text-sl-text-muted">&copy; {{ date('Y') }} Skills LABS — Institut Teknologi Batam. All rights reserved.</p>
                <div class="flex items-center gap-1.5">
                    <span class="status-online"></span>
                    <span class="text-xs text-sl-green-2">System Online</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Navbar scroll effect --}}
    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.style.backdropFilter = 'blur(12px)';
                navbar.style.boxShadow = '0 4px 24px rgba(0,0,0,0.4)';
            } else {
                navbar.style.backdropFilter = '';
                navbar.style.boxShadow = '';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
