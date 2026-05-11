<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Skills LABS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sl-bg text-sl-text min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <div class="absolute inset-0 dot-bg opacity-30"></div>
    <div class="absolute top-20 left-20 w-72 h-72 bg-sl-red rounded-full blur-3xl opacity-5"></div>
    <div class="absolute bottom-20 right-20 w-56 h-56 bg-sl-purple rounded-full blur-3xl opacity-5"></div>

    <div class="relative z-10 w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
                <div class="w-12 h-12 bg-sl-red rounded-xl flex items-center justify-center shadow-glow-red">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </div>
                <span class="font-display font-extrabold text-xl text-sl-text">Skills<span class="text-sl-red">LABS</span></span>
            </a>
        </div>

        <div class="sl-card p-8">
            <h1 class="font-display text-2xl font-extrabold text-sl-text mb-1 text-center">Selamat Datang!</h1>
            <p class="text-sl-text-2 text-sm text-center mb-6">Masuk ke akun Skills LABS kamu</p>

            @if($errors->any())
                <div class="alert-error mb-4">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $errors->first() }}
                </div>
            @endif
            @if(session('status'))
                <div class="alert-success mb-4">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label-dark">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="input-dark" placeholder="email@example.com">
                </div>
                <div>
                    <label class="label-dark">Password</label>
                    <input type="password" name="password" required
                           class="input-dark" placeholder="Password kamu">
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-sl-text-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-sl-surface border-sl-border text-sl-red focus:ring-sl-red focus:ring-offset-sl-bg">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sl-red hover:underline text-xs">Lupa password?</a>
                    @endif
                </div>
                <button type="submit" class="btn-primary w-full justify-center py-3.5">
                    Masuk ke Skills LABS
                </button>
            </form>

            {{-- Demo credentials --}}
            <div class="mt-4 p-3 bg-sl-bg rounded-lg border border-sl-border text-xs font-mono">
                <p class="text-sl-text-muted mb-1"># Demo credentials:</p>
                <p class="text-sl-green-2">Admin: admin@skillslabs.iteba.ac.id / admin123</p>
                <p class="text-sl-blue">Student: mahasiswa@example.com / password</p>
            </div>
        </div>

        <p class="text-center text-sm text-sl-text-muted mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-sl-red hover:underline font-semibold">Daftar gratis sekarang</a>
        </p>
        <p class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-sl-text-muted text-xs hover:text-sl-red transition-colors">← Kembali ke halaman utama</a>
        </p>
    </div>
</body>
</html>
