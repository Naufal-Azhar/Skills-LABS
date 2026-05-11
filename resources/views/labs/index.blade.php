@extends('layouts.app')
@section('title', 'Katalog Labs')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ─── HEADER ─── --}}
    <div class="mb-8">
        <div class="section-tag">Katalog</div>
        <h1 class="font-display text-3xl font-extrabold text-sl-text mb-2">Semua Labs</h1>
        <p class="text-sl-text-2">Pilih lab yang sesuai dengan skill yang ingin kamu pelajari.</p>
    </div>

    {{-- ─── FILTER BAR ─── --}}
    <form method="GET" action="{{ route('labs.index') }}"
          class="sl-card p-4 mb-6 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-48">
            <label class="label-dark">Cari Lab</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="input-dark" placeholder="Nama lab...">
        </div>
        <div class="min-w-44">
            <label class="label-dark">Kategori</label>
            <select name="category" class="select-dark">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                        {{ $cat->icon }} {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="min-w-36">
            <label class="label-dark">Level</label>
            <select name="level" class="select-dark">
                <option value="">Semua Level</option>
                <option value="beginner"     {{ request('level') == 'beginner'     ? 'selected' : '' }}>🟢 Pemula</option>
                <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : '' }}>🟡 Menengah</option>
                <option value="advanced"     {{ request('level') == 'advanced'     ? 'selected' : '' }}>🔴 Lanjutan</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn-primary py-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Filter
            </button>
            @if(request()->anyFilled(['search','category','level']))
            <a href="{{ route('labs.index') }}" class="btn-secondary py-3">Reset</a>
            @endif
        </div>
    </form>

    {{-- ─── CATEGORY PILLS ─── --}}
    @if($categories->isNotEmpty())
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('labs.index') }}"
           class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all duration-150
                  {{ !request('category') ? 'bg-sl-red text-white border-sl-red' : 'bg-sl-surface border-sl-border text-sl-text-2 hover:border-sl-red hover:text-sl-red' }}">
            All
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('labs.index', ['category' => $cat->slug]) }}"
           class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all duration-150
                  {{ request('category') == $cat->slug ? 'bg-sl-red text-white border-sl-red' : 'bg-sl-surface border-sl-border text-sl-text-2 hover:border-sl-red hover:text-sl-red' }}">
            {{ $cat->icon }} {{ $cat->name }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- ─── RESULTS ─── --}}
    @if($labs->isEmpty())
        <div class="sl-card p-12 text-center">
            <div class="w-16 h-16 bg-sl-surface border border-sl-border rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-sl-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <p class="text-sl-text font-semibold mb-1">Tidak ada lab ditemukan</p>
            <p class="text-sl-text-2 text-sm">Coba kata kunci atau filter yang berbeda</p>
        </div>
    @else
        @php
        $stripMap = [
            'programming-fundamentals' => 'strip-red',
            'web-development'          => 'strip-blue',
            'networking-systems'       => 'strip-gray',
            'iot-embedded'             => 'strip-green',
            'ai-data-science'          => 'strip-purple',
            'database'                 => 'strip-yellow',
        ];
        @endphp

        <div class="mb-3 text-sm text-sl-text-muted font-mono">
            Menampilkan <span class="text-sl-text font-bold">{{ $labs->total() }}</span> labs
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($labs as $lab)
            @php $strip = $stripMap[$lab->category->slug] ?? 'strip-red'; @endphp
            <a href="{{ route('labs.show', $lab->slug) }}"
               class="sl-card-hover flex flex-col group {{ $strip }}">
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xl">{{ $lab->category->icon }}</span>
                        <span class="badge-cat">{{ $lab->category->name }}</span>
                        <span class="ml-auto
                            @if($lab->level === 'beginner') badge-beginner
                            @elseif($lab->level === 'intermediate') badge-intermediate
                            @else badge-advanced @endif">
                            {{ $lab->level_label }}
                        </span>
                    </div>
                    <h3 class="font-bold text-sl-text mb-2 group-hover:text-sl-red transition-colors leading-tight">
                        {{ $lab->title }}
                    </h3>
                    <p class="text-sl-text-2 text-sm line-clamp-2 flex-1 mb-4">{{ $lab->description }}</p>
                    <div class="flex items-center justify-between text-xs text-sl-text-muted pt-3 border-t border-sl-border font-mono">
                        <span>📝 {{ $lab->modules_count ?? 0 }} Modul</span>
                        <span>⏱ {{ $lab->estimated_duration }}m</span>
                        <span>👁 {{ $lab->views }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $labs->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
