@extends('layouts.app')
@section('title', $lab->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="text-xs text-sl-text-muted mb-6 flex items-center gap-1.5 font-mono">
        <a href="{{ route('labs.index') }}" class="hover:text-sl-red transition-colors">Labs</a>
        <span>/</span>
        <a href="{{ route('labs.index', ['category' => $lab->category->slug]) }}" class="hover:text-sl-red transition-colors">{{ $lab->category->name }}</a>
        <span>/</span>
        <span class="text-sl-text-2 truncate">{{ $lab->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ─── MAIN CONTENT ─── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Title & Meta --}}
            <div class="sl-card p-6 relative overflow-hidden">
                @php
                $stripMap = ['programming-fundamentals'=>'strip-red','web-development'=>'strip-blue','networking-systems'=>'strip-gray','iot-embedded'=>'strip-green','ai-data-science'=>'strip-purple','database'=>'strip-yellow'];
                $strip = $stripMap[$lab->category->slug] ?? 'strip-red';
                @endphp
                <div class="absolute top-0 left-0 right-0 h-0.5
                    @if(($stripMap[$lab->category->slug] ?? '') === 'strip-red') bg-sl-red
                    @elseif(($stripMap[$lab->category->slug] ?? '') === 'strip-blue') bg-sl-blue
                    @elseif(($stripMap[$lab->category->slug] ?? '') === 'strip-green') bg-sl-green-2
                    @elseif(($stripMap[$lab->category->slug] ?? '') === 'strip-purple') bg-sl-purple
                    @elseif(($stripMap[$lab->category->slug] ?? '') === 'strip-yellow') bg-sl-yellow
                    @else bg-sl-text-muted @endif"></div>

                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="text-2xl">{{ $lab->category->icon }}</span>
                    <span class="badge-cat">{{ $lab->category->name }}</span>
                    <span class="
                        @if($lab->level === 'beginner') badge-beginner
                        @elseif($lab->level === 'intermediate') badge-intermediate
                        @else badge-advanced @endif">
                        {{ $lab->level_label }}
                    </span>
                    @if($lab->is_featured)
                        <span class="bg-sl-yellow-dim text-sl-yellow border border-sl-yellow text-xs font-bold px-2 py-0.5 rounded uppercase tracking-wider">⭐ Unggulan</span>
                    @endif
                </div>

                <h1 class="font-display text-2xl font-extrabold text-sl-text mb-3">{{ $lab->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-sl-text-muted font-mono">
                    <span>📝 {{ $lab->modules->count() }} Modul</span>
                    <span>⏱ {{ $lab->estimated_duration }} menit</span>
                    <span>👁 {{ $lab->views }} views</span>
                    @if($lab->major)
                        <span>🎓 {{ $lab->major->name }}</span>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            <div class="sl-card p-6">
                <h2 class="font-bold text-sl-text text-base mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tentang Lab Ini
                </h2>
                <p class="text-sl-text-2 leading-relaxed text-sm">{{ $lab->description }}</p>
            </div>

            @if($lab->objective)
            <div class="sl-card p-6 border-l-2 border-sl-blue">
                <h2 class="font-bold text-sl-text text-base mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sl-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tujuan Pembelajaran
                </h2>
                <div class="text-sl-text-2 text-sm leading-relaxed whitespace-pre-line">{{ $lab->objective }}</div>
            </div>
            @endif

            {{-- Modules List --}}
            <div class="sl-card p-6">
                <h2 class="font-bold text-sl-text text-base mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Daftar Modul
                    <span class="ml-auto text-xs font-mono text-sl-text-muted">{{ $lab->modules->count() }} modul</span>
                </h2>
                <div class="space-y-2">
                    @forelse($lab->modules as $i => $module)
                    <div class="flex items-center gap-4 p-3 rounded-lg bg-sl-bg border border-sl-border-sub hover:border-sl-border transition-colors">
                        <div class="w-7 h-7 flex-shrink-0 rounded-full
                            {{ $enrollment ? 'bg-sl-red-dim border border-sl-red text-sl-red' : 'bg-sl-surface border border-sl-border text-sl-text-muted' }}
                            flex items-center justify-center text-xs font-bold font-mono">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-sl-text text-sm">{{ $module->title }}</div>
                            <div class="text-xs text-sl-text-muted font-mono mt-0.5">
                                ⏱ {{ $module->estimated_duration }}m
                                @if($module->video_url) · 🎬 Video @endif
                                @if($module->code_example) · 💻 Code @endif
                            </div>
                        </div>
                        @if($enrollment)
                            <a href="{{ route('modules.show', [$lab->slug, $module->id]) }}"
                               class="text-xs text-sl-red hover:underline font-bold flex-shrink-0">Buka →</a>
                        @else
                            <svg class="w-4 h-4 text-sl-text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        @endif
                    </div>
                    @empty
                        <p class="text-sl-text-muted text-sm text-center py-4">Modul belum tersedia</p>
                    @endforelse
                </div>
            </div>

            @if($lab->prerequisites)
            <div class="sl-card p-6">
                <h2 class="font-bold text-sl-text text-base mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sl-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Prerequisite
                </h2>
                <div class="text-sl-text-2 text-sm whitespace-pre-line">{{ $lab->prerequisites }}</div>
            </div>
            @endif

            @if($lab->tools_needed)
            <div class="sl-card p-6">
                <h2 class="font-bold text-sl-text text-base mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-sl-green-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Tools yang Dibutuhkan
                </h2>
                <div class="text-sl-text-2 text-sm whitespace-pre-line">{{ $lab->tools_needed }}</div>
            </div>
            @endif
        </div>

        {{-- ─── SIDEBAR ─── --}}
        <div class="lg:col-span-1">
            <div class="sticky top-20 space-y-4">

                {{-- Enrollment Card --}}
                <div class="sl-card p-6">
                    @if(!auth()->check())
                        <div class="text-center">
                            <div class="w-14 h-14 bg-sl-red-dim border border-sl-red rounded-xl flex items-center justify-center mx-auto mb-4 shadow-glow-red">
                                <svg class="w-7 h-7 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <h3 class="font-bold text-sl-text mb-2">Login untuk Mulai Belajar</h3>
                            <p class="text-sl-text-2 text-sm mb-4">Lab ini gratis untuk mahasiswa ITEBA yang sudah terdaftar.</p>
                            <a href="{{ route('register') }}" class="btn-primary w-full justify-center mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                Daftar Gratis
                            </a>
                            <a href="{{ route('login') }}" class="btn-secondary w-full justify-center text-xs">
                                Sudah punya akun? Masuk
                            </a>
                        </div>

                    @elseif($enrollment)
                        @if($enrollment->isCompleted())
                            <div class="text-center">
                                <div class="w-14 h-14 bg-sl-yellow-dim border border-sl-yellow rounded-xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-7 h-7 text-sl-yellow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                </div>
                                <h3 class="font-bold text-sl-yellow mb-1">Lab Selesai!</h3>
                                <p class="text-sl-text-2 text-sm mb-4">Kamu sudah menyelesaikan lab ini.</p>
                                <a href="{{ route('certificates.index') }}" class="btn-primary w-full justify-center">
                                    Lihat Sertifikat
                                </a>
                            </div>
                        @else
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-sl-text-2 mb-2">
                                    <span>Progress</span>
                                    <span class="font-bold font-mono text-sl-text">{{ $enrollment->progress_percent }}%</span>
                                </div>
                                <div class="progress-track h-2">
                                    <div class="progress-fill h-2" style="width: {{ $enrollment->progress_percent }}%"></div>
                                </div>
                            </div>
                            <a href="{{ route('labs.learn', $lab->slug) }}" class="btn-primary w-full justify-center">
                                Lanjutkan Belajar
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @endif

                    @else
                        <div class="text-center">
                            <div class="w-14 h-14 bg-sl-red-dim border border-sl-red rounded-xl flex items-center justify-center mx-auto mb-4 shadow-glow-red">
                                <svg class="w-7 h-7 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            </div>
                            <h3 class="font-bold text-sl-text mb-3">Mulai Lab Ini</h3>
                            <div class="text-sm text-sl-text-2 space-y-1.5 mb-5 text-left bg-sl-bg rounded-lg p-3 border border-sl-border">
                                <div class="flex items-center gap-2">
                                    <span class="text-sl-text-muted">📝</span>
                                    <span>{{ $lab->modules->count() }} modul</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sl-text-muted">⏱</span>
                                    <span>{{ $lab->estimated_duration }} menit</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sl-text-muted">📊</span>
                                    <span>Level {{ $lab->level_label }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sl-green-2">✓</span>
                                    <span class="text-sl-green-2 font-semibold">Gratis — Include UKT</span>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('enrollments.store', $lab->slug) }}">
                                @csrf
                                <button type="submit" class="btn-primary w-full justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    Enroll & Mulai Belajar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                {{-- Related Labs --}}
                @if($relatedLabs->isNotEmpty())
                <div class="sl-card p-5">
                    <h3 class="font-bold text-sl-text mb-3 text-sm">Labs Terkait</h3>
                    <div class="space-y-2">
                        @foreach($relatedLabs as $related)
                        <a href="{{ route('labs.show', $related->slug) }}"
                           class="flex items-center gap-3 p-2 rounded-lg hover:bg-sl-surface transition-colors group">
                            <span class="text-xl flex-shrink-0">{{ $related->category->icon }}</span>
                            <span class="text-sm text-sl-text-2 group-hover:text-sl-red transition-colors line-clamp-2">{{ $related->title }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
