@extends('layouts.app')
@section('title', $module->title . ' — ' . $lab->title)

@section('content')
<div class="flex h-[calc(100vh-64px)]">

    {{-- ─── SIDEBAR MODUL ─── --}}
    <aside class="w-72 bg-sl-surface border-r border-sl-border flex flex-col overflow-hidden hidden lg:flex flex-shrink-0">
        {{-- Lab Info --}}
        <div class="p-4 border-b border-sl-border">
            <a href="{{ route('labs.show', $lab->slug) }}"
               class="text-xs text-sl-red hover:underline font-semibold flex items-center gap-1 mb-3">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Lab
            </a>
            <h2 class="font-bold text-sl-text text-sm leading-tight mb-3">{{ $lab->title }}</h2>
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

        {{-- Module List --}}
        <nav class="flex-1 overflow-y-auto p-3 space-y-1 scrollbar-thin">
            @foreach($modules as $i => $m)
            @php $done = in_array($m->id, $completedModuleIds); @endphp
            <a href="{{ route('modules.show', [$lab->slug, $m->id]) }}"
               class="flex items-start gap-3 p-3 rounded-lg text-sm transition-all duration-150
                      {{ $m->id === $module->id
                          ? 'bg-sl-red-dim border border-sl-red text-sl-red'
                          : 'text-sl-text-2 hover:bg-sl-card hover:text-sl-text' }}">
                <div class="w-6 h-6 flex-shrink-0 rounded-full flex items-center justify-center text-xs font-bold mt-0.5
                    {{ $done
                        ? 'bg-sl-green-2 text-sl-bg'
                        : ($m->id === $module->id
                            ? 'bg-sl-red text-white'
                            : 'bg-sl-surface border border-sl-border text-sl-text-muted') }}">
                    {{ $done ? '✓' : ($i + 1) }}
                </div>
                <span class="leading-tight {{ $m->id === $module->id ? 'font-semibold' : '' }}">{{ $m->title }}</span>
            </a>
            @endforeach
        </nav>
    </aside>

    {{-- ─── MAIN MODULE CONTENT ─── --}}
    <div class="flex-1 overflow-y-auto bg-sl-bg">
        <div class="max-w-4xl mx-auto px-6 py-8">

            {{-- Module Header --}}
            <div class="mb-6">
                <div class="flex flex-wrap items-center gap-2 text-xs text-sl-text-muted font-mono mb-2">
                    <span>{{ $lab->category->icon }}</span>
                    <span>{{ $lab->title }}</span>
                    <span>·</span>
                    <span>⏱ {{ $module->estimated_duration }} menit</span>
                    @if($isCompleted)
                        <span class="badge-beginner">✓ Selesai</span>
                    @endif
                </div>
                <h1 class="font-display text-2xl font-extrabold text-sl-text">{{ $module->title }}</h1>
            </div>

            {{-- Video --}}
            @if($module->video_url && $module->youtube_embed_id)
            <div class="mb-6 sl-card overflow-hidden">
                <div class="terminal-header">
                    <span class="terminal-dot bg-red-500"></span>
                    <span class="terminal-dot bg-yellow-500"></span>
                    <span class="terminal-dot bg-green-500"></span>
                    <span class="text-sl-red text-xs font-bold font-mono ml-2">▶ VIDEO TUTORIAL</span>
                </div>
                <div class="aspect-video">
                    <iframe class="w-full h-full"
                            src="https://www.youtube.com/embed/{{ $module->youtube_embed_id }}"
                            title="{{ $module->title }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
            @endif

            {{-- Content --}}
            @if($module->content)
            <div class="sl-card p-6 mb-6">
                <div class="text-sl-text-2 leading-relaxed whitespace-pre-line text-sm">{{ $module->content }}</div>
            </div>
            @endif

            {{-- Code Example --}}
            @if($module->code_example)
            <div class="terminal mb-6">
                <div class="terminal-header">
                    <span class="terminal-dot bg-red-500"></span>
                    <span class="terminal-dot bg-yellow-500"></span>
                    <span class="terminal-dot bg-green-500"></span>
                    <span class="text-sl-text-muted text-xs ml-2 font-mono">{{ $module->code_language ?? 'code' }}</span>
                    <span class="ml-auto text-xs text-sl-text-muted">💻 Code Praktik</span>
                </div>
                <div class="terminal-body">
                    <pre class="text-sl-green overflow-x-auto text-sm leading-relaxed"><code>{{ $module->code_example }}</code></pre>
                </div>
            </div>
            @endif

            {{-- Reference --}}
            @if($module->reference_url)
            <div class="sl-card p-4 mb-6 border-l-2 border-sl-blue flex items-start gap-3">
                <svg class="w-5 h-5 text-sl-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <div>
                    <div class="font-semibold text-sl-blue text-sm mb-1">Referensi Materi</div>
                    <a href="{{ $module->reference_url }}" target="_blank" rel="noopener noreferrer"
                       class="text-sl-text-2 text-sm hover:text-sl-blue transition-colors break-all">
                        {{ $module->reference_url }} ↗
                    </a>
                </div>
            </div>
            @endif

            {{-- Checkpoint --}}
            @if($module->checkpoint)
            <div class="sl-card p-6 mb-6 border-l-2 border-sl-yellow">
                <h3 class="font-bold text-sl-yellow text-base mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Checkpoint — Latihan Hands-On
                </h3>
                <div class="text-sl-text-2 text-sm leading-relaxed whitespace-pre-line">{{ $module->checkpoint }}</div>
            </div>
            @endif

            {{-- Navigation & Complete --}}
            <div class="flex items-center justify-between gap-4 pt-6 border-t border-sl-border">
                <div>
                    @if($prevModule)
                    <a href="{{ route('modules.show', [$lab->slug, $prevModule->id]) }}"
                       class="btn-ghost text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Sebelumnya
                    </a>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    @if(!$isCompleted)
                    <form method="POST" action="{{ route('modules.complete', $module->id) }}">
                        @csrf
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Tandai Selesai
                        </button>
                    </form>
                    @else
                        <span class="badge-beginner px-4 py-2 text-sm">✓ Modul Selesai</span>
                        @if($nextModule)
                        <a href="{{ route('modules.show', [$lab->slug, $nextModule->id]) }}"
                           class="btn-primary">
                            Modul Berikutnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endif
                    @endif
                </div>

                <div>
                    @if($nextModule && !$isCompleted)
                    <a href="{{ route('modules.show', [$lab->slug, $nextModule->id]) }}"
                       class="btn-ghost text-sm">
                        Berikutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
