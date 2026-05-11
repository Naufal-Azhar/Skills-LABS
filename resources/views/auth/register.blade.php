<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Skills LABS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sl-bg text-sl-text min-h-screen">
<div class="min-h-screen flex">

    {{-- Left Panel --}}
    <div class="hidden lg:flex lg:w-5/12 bg-sl-surface border-r border-sl-border flex-col justify-between p-10 relative overflow-hidden">
        <div class="absolute inset-0 dot-bg opacity-30"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-sl-red rounded-full blur-3xl opacity-5"></div>
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-12">
                <div class="w-8 h-8 bg-sl-red rounded-lg flex items-center justify-center shadow-glow-red">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </div>
                <span class="font-display font-extrabold text-sl-text">Skills<span class="text-sl-red">LABS</span></span>
            </a>
            <h2 class="font-display text-3xl font-extrabold text-sl-text mb-4 leading-tight">
                Mulai Perjalanan<br>Belajarmu Hari Ini
            </h2>
            <p class="text-sl-text-2 mb-8 leading-relaxed">Akses puluhan labs hands-on, kerjakan latihan praktik, dan dapatkan sertifikat digital — gratis!</p>

            <div class="space-y-3">
                @foreach([
                    ['icon'=>'💻','title'=>'Hands-On Learning','desc'=>'Belajar dengan praktik langsung'],
                    ['icon'=>'🎓','title'=>'Sertifikat Digital','desc'=>'Dapatkan sertifikat saat lab selesai'],
                    ['icon'=>'⚡','title'=>'Gratis — Include UKT','desc'=>'Tidak perlu bayar extra'],
                ] as $f)
                <div class="sl-card px-4 py-3 flex items-center gap-3">
                    <span class="text-2xl">{{ $f['icon'] }}</span>
                    <div>
                        <div class="font-semibold text-sl-text text-sm">{{ $f['title'] }}</div>
                        <div class="text-sl-text-2 text-xs">{{ $f['desc'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <p class="text-sl-text-muted text-xs relative z-10">&copy; {{ date('Y') }} Skills LABS — ITEBA</p>
    </div>

    {{-- Right Panel --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-10">
        <div class="w-full max-w-md">
            <div class="lg:hidden mb-6 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                    <div class="w-8 h-8 bg-sl-red rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></div>
                    <span class="font-display font-extrabold text-sl-text">Skills<span class="text-sl-red">LABS</span></span>
                </a>
            </div>

            <h1 class="font-display text-2xl font-extrabold text-sl-text mb-1">Buat Akun Baru</h1>
            <p class="text-sl-text-2 text-sm mb-6">Daftar menggunakan NIM dan data akademik kamu.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label-dark">Nama Lengkap <span class="text-sl-red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                           class="input-dark @error('name') border-sl-red @enderror"
                           placeholder="Nama lengkap sesuai KTM">
                    @error('name')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label-dark">NIM <span class="text-sl-red">*</span></label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required
                           class="input-dark font-mono @error('nim') border-sl-red @enderror"
                           placeholder="Contoh: TK2024001">
                    @error('nim')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label-dark">Email <span class="text-sl-red">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="input-dark @error('email') border-sl-red @enderror"
                           placeholder="email@example.com">
                    @error('email')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="label-dark">Jurusan <span class="text-sl-red">*</span></label>
                        <select name="major_id" required class="select-dark @error('major_id') border-sl-red @enderror">
                            <option value="">-- Pilih --</option>
                            @foreach($faculties as $faculty)
                                <optgroup label="{{ $faculty->name }}">
                                    @foreach($faculty->majors as $major)
                                        <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('major_id')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label-dark">Semester <span class="text-sl-red">*</span></label>
                        <select name="semester" required class="select-dark @error('semester') border-sl-red @enderror">
                            <option value="">-- Pilih --</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                        @error('semester')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="label-dark">Password <span class="text-sl-red">*</span></label>
                        <input type="password" name="password" required
                               class="input-dark @error('password') border-sl-red @enderror"
                               placeholder="Min. 8 karakter">
                        @error('password')<p class="text-sl-red text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label-dark">Konfirmasi <span class="text-sl-red">*</span></label>
                        <input type="password" name="password_confirmation" required
                               class="input-dark" placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3.5 mt-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Buat Akun Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-sl-text-muted mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-sl-red hover:underline font-semibold">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
