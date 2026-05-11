@extends('layouts.app')
@section('title', 'Progress Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <div class="section-tag">Tracking</div>
        <h1 class="font-display text-3xl font-extrabold text-sl-text mb-2">Progress Belajar</h1>
        <p class="text-sl-text-2">Pantau kemajuan kamu di setiap lab yang diikuti.</p>
    </div>

    @if($enrollments->isEmpty())
        <div class="sl-card p-12 text-center">
            <div class="w-16 h-16 bg-sl-surface border border-sl-border rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-sl-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="font-display text-xl font-bold text-sl-text mb-2">Belum ada progress</h3>
            <p class="text-sl-text-2 mb-6">Mulai ikuti lab untuk memantau progress belajarmu</p>
            <a href="{{ route('labs.index') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Jelajahi Labs
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($enrollments as $enrollment)
            @php
            $stripMap = ['programming-fundamentals'=>'strip-red','web-development'=>'strip-blue','networking-systems'=>'strip-gray','iot-embedded'=>'strip-green','ai-data-science'=>'strip-purple','database'=>'strip-yellow'];
            $strip = $stripMap[$enrollment->lab->category->slug] ?? 'strip-red';
            @endphp
            <div class="sl-card p-6 {{ $strip }}">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="text-base">{{ $enrollment->lab->category->icon }}</span>
                            <span class="badge-cat">{{ $enrollment->lab->category->name }}</span>
                            <span class="
                                @if($enrollment->lab->level === 'beginner') badge-beginner
                                @elseif($enrollment->lab->level === 'intermediate') badge-intermediate
                                @else badge-advanced @endif">
                                {{ $enrollment->lab->level_label }}
                            </span>
                        </div>
                        <h3 class="font-bold text-sl-text text-lg mb-1">{{ $enrollment->lab->title }}</h3>
                        <p class="text-xs text-sl-text-muted font-mono">
                            Mulai: {{ $enrollment->enrolled_at->format('d M Y') }}
                            @if($enrollment->completed_at)
                                · Selesai: {{ $enrollment->completed_at->format('d M Y') }}
                            @endif
                        </p>
                    </div>
                    @if($enrollment->isCompleted())
                        <span class="flex-shrink-0 badge-beginner px-3 py-1.5 text-sm">✓ Selesai</span>
                    @else
                        <a href="{{ route('labs.learn', $enrollment->lab->slug) }}"
                           class="flex-shrink-0 btn-primary text-xs px-4 py-2">
                            Lanjutkan
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                </div>

                {{-- Progress Bar --}}
                <div class="mb-3">
                    <div class="flex justify-between text-sm text-sl-text-2 mb-2">
                        <span>Progress keseluruhan</span>
                        <span class="font-bold font-mono text-sl-text">{{ $enrollment->progress_percent }}%</span>
                    </div>
                    <div class="progress-track h-2">
                        @if($enrollment->isCompleted())
                            <div class="h-2 rounded-full transition-all" style="width: 100%; background: linear-gradient(90deg, #20C997 0%, #00FF41 100%)"></div>
                        @else
                            <div class="progress-fill h-2" style="width: {{ $enrollment->progress_percent }}%"></div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4 text-xs text-sl-text-muted font-mono">
                    <span>📝 {{ $enrollment->lab->modules->count() }} modul</span>
                    <span>⏱ {{ $enrollment->lab->estimated_duration }} menit</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
