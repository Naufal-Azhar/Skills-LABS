@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ─── PROFILE HEADER ─── --}}
    <div class="sl-card p-6 mb-6 relative overflow-hidden">
        <div class="absolute inset-0 dot-bg opacity-20"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-sl-red rounded-full blur-3xl opacity-5"></div>
        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-5">
            <div class="relative flex-shrink-0">
                <img src="{{ $user->avatar_url }}" alt="Avatar"
                     class="w-16 h-16 rounded-xl border-2 border-sl-border shadow-card-dark">
                <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-sl-green-2 rounded-full border-2 border-sl-card"></span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <h1 class="font-display text-xl font-extrabold text-sl-text">{{ $user->name }}</h1>
                    <span class="badge-cat font-mono text-xs">{{ $user->nim }}</span>
                </div>
                <p class="text-sl-text-2 text-sm">
                    {{ $user->major?->name ?? 'ITEBA' }}
                    @if($user->semester) · Semester {{ $user->semester }} @endif
                </p>
                <div class="flex items-center gap-1.5 mt-1">
                    <span class="status-online"></span>
                    <span class="text-xs text-sl-green-2 font-mono">Online</span>
                </div>
            </div>
            {{-- Gamification badges --}}
            <div class="flex items-center gap-4 flex-shrink-0">
                <div class="text-center">
                    <div class="text-xl font-extrabold text-sl-red font-display">{{ $enrollments->count() }}</div>
                    <div class="text-xs text-sl-text-muted">Labs</div>
                </div>
                <div class="w-px h-8 bg-sl-border"></div>
                <div class="text-center">
                    <div class="text-xl font-extrabold text-sl-yellow font-display">{{ $completedCount }}</div>
                    <div class="text-xs text-sl-text-muted">Selesai</div>
                </div>
                <div class="w-px h-8 bg-sl-border"></div>
                <div class="text-center">
                    <div class="text-xl font-extrabold text-sl-green-2 font-display">{{ $certificates->count() }}</div>
                    <div class="text-xs text-sl-text-muted">Sertifikat</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── STATS CARDS ─── --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['val' => $enrollments->count(), 'label' => 'Labs Diikuti',   'color' => 'text-sl-red',    'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            ['val' => $completedCount,        'label' => 'Labs Selesai',   'color' => 'text-sl-green-2','icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['val' => $certificates->count(), 'label' => 'Sertifikat',     'color' => 'text-sl-yellow', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ['val' => $totalModules,          'label' => 'Total Modul',    'color' => 'text-sl-blue',   'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ] as $s)
        <div class="stat-card">
            <div class="flex items-center justify-between mb-2">
                <span class="stat-label">{{ $s['label'] }}</span>
                <svg class="w-4 h-4 text-sl-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                </svg>
            </div>
            <div class="stat-value {{ $s['color'] }}">{{ $s['val'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ─── LABS AKTIF ─── --}}
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-display font-bold text-sl-text">Labs yang Sedang Diikuti</h2>
                <a href="{{ route('labs.index') }}" class="btn-ghost text-xs">Jelajahi Labs →</a>
            </div>

            @if($enrollments->isEmpty())
                <div class="sl-card p-10 text-center">
                    <div class="w-16 h-16 bg-sl-red-dim border border-sl-red rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <p class="text-sl-text font-semibold mb-1">Belum ada lab yang diikuti</p>
                    <p class="text-sl-text-2 text-sm mb-5">Mulai belajar dengan memilih lab yang kamu inginkan</p>
                    <a href="{{ route('labs.index') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Jelajahi Labs
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($enrollments as $enrollment)
                    <div class="sl-card p-4 hover:border-sl-border transition-all">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-base">{{ $enrollment->lab->category->icon }}</span>
                                    <span class="badge-cat">{{ $enrollment->lab->category->name }}</span>
                                    @if($enrollment->isCompleted())
                                        <span class="badge-beginner">✓ Selesai</span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-sl-text truncate mb-2">{{ $enrollment->lab->title }}</h3>
                                <div>
                                    <div class="flex justify-between text-xs text-sl-text-muted mb-1.5">
                                        <span>Progress</span>
                                        <span class="font-mono font-bold text-sl-text-2">{{ $enrollment->progress_percent }}%</span>
                                    </div>
                                    <div class="progress-track h-1.5">
                                        <div class="progress-fill h-1.5" style="width: {{ $enrollment->progress_percent }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('labs.learn', $enrollment->lab->slug) }}"
                               class="flex-shrink-0 btn-primary text-xs px-3 py-2">
                                {{ $enrollment->progress_percent > 0 ? 'Lanjutkan' : 'Mulai' }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ─── SIDEBAR KANAN ─── --}}
        <div class="space-y-5">

            {{-- Rekomendasi --}}
            <div>
                <h2 class="font-display font-bold text-sl-text mb-3">Rekomendasi Untukmu</h2>
                <div class="space-y-2">
                    @forelse($recommendedLabs as $lab)
                    <a href="{{ route('labs.show', $lab->slug) }}"
                       class="sl-card-hover p-3 flex items-center gap-3 block">
                        <div class="text-2xl flex-shrink-0">{{ $lab->category->icon }}</div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-semibold text-sl-text truncate">{{ $lab->title }}</div>
                            <div class="text-xs text-sl-text-muted font-mono">
                                @if($lab->level === 'beginner') <span class="text-sl-green-2">Beginner</span>
                                @elseif($lab->level === 'intermediate') <span class="text-sl-yellow">Intermediate</span>
                                @else <span class="text-sl-red">Advanced</span>
                                @endif
                                · {{ $lab->estimated_duration }}m
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-sl-text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @empty
                    <div class="sl-card p-4 text-center">
                        <p class="text-sl-green-2 text-sm font-semibold">🎉 Semua labs sudah kamu ikuti!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Sertifikat --}}
            @if($certificates->isNotEmpty())
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-display font-bold text-sl-text">Sertifikat Terbaru</h2>
                    <a href="{{ route('certificates.index') }}" class="btn-ghost text-xs">Lihat semua →</a>
                </div>
                <div class="space-y-2">
                    @foreach($certificates->take(3) as $cert)
                    <div class="sl-card p-3 strip-yellow">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-sl-yellow-dim border border-sl-yellow rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-sl-yellow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-sl-text truncate">{{ $cert->lab->title }}</div>
                                <div class="text-xs text-sl-text-muted font-mono">{{ $cert->issued_at->format('d M Y') }}</div>
                            </div>
                            <a href="{{ route('certificates.download', $cert->certificate_code) }}"
                               class="text-xs text-sl-yellow hover:underline font-bold flex-shrink-0">PDF</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
