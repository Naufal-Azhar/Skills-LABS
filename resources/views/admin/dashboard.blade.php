@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['val' => $stats['students'],    'label' => 'Total Mahasiswa',  'color' => 'text-sl-blue',    'dim' => 'bg-sl-blue-dim border-sl-blue',    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
        ['val' => $stats['labs'],        'label' => 'Total Labs',       'color' => 'text-sl-purple',  'dim' => 'bg-sl-purple-dim border-sl-purple', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
        ['val' => $stats['enrollments'], 'label' => 'Enrollments',      'color' => 'text-sl-green-2', 'dim' => 'bg-sl-green-dim border-sl-green-2', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['val' => $stats['certificates'],'label' => 'Sertifikat',       'color' => 'text-sl-yellow',  'dim' => 'bg-sl-yellow-dim border-sl-yellow', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
    ] as $s)
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <span class="stat-label">{{ $s['label'] }}</span>
            <div class="w-9 h-9 {{ $s['dim'] }} border rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 {{ $s['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                </svg>
            </div>
        </div>
        <div class="stat-value {{ $s['color'] }}">{{ $s['val'] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Students --}}
    <div class="sl-card overflow-hidden">
        <div class="p-5 border-b border-sl-border flex items-center justify-between">
            <h3 class="font-bold text-sl-text">Mahasiswa Terbaru</h3>
            <a href="{{ route('admin.students.index') }}" class="btn-ghost text-xs">Lihat semua →</a>
        </div>
        <div class="divide-y divide-sl-border-sub">
            @foreach($recentStudents as $student)
            <div class="p-4 flex items-center gap-3 hover:bg-sl-surface transition-colors">
                <img src="{{ $student->avatar_url }}" alt="" class="w-9 h-9 rounded-full border border-sl-border flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-sl-text text-sm truncate">{{ $student->name }}</div>
                    <div class="text-xs text-sl-text-muted font-mono">{{ $student->nim }} · {{ $student->major?->name ?? '-' }}</div>
                </div>
                <span class="text-xs font-bold px-2 py-0.5 rounded flex-shrink-0
                    {{ $student->is_active ? 'bg-sl-green-dim text-sl-green-2 border border-sl-green-2' : 'bg-sl-red-dim text-sl-red border border-sl-red' }}">
                    {{ $student->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Popular Labs --}}
    <div class="sl-card overflow-hidden">
        <div class="p-5 border-b border-sl-border flex items-center justify-between">
            <h3 class="font-bold text-sl-text">Labs Terpopuler</h3>
            <a href="{{ route('admin.labs.index') }}" class="btn-ghost text-xs">Kelola Labs →</a>
        </div>
        <div class="divide-y divide-sl-border-sub">
            @foreach($popularLabs as $i => $lab)
            <div class="p-4 flex items-center gap-3 hover:bg-sl-surface transition-colors">
                <div class="w-8 h-8 flex-shrink-0 bg-sl-red-dim border border-sl-red rounded-lg flex items-center justify-center text-sm font-bold text-sl-red font-mono">
                    {{ $i + 1 }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-sl-text text-sm truncate">{{ $lab->title }}</div>
                    <div class="text-xs text-sl-text-muted">{{ $lab->category->name }}</div>
                </div>
                <div class="text-xs font-bold text-sl-text-2 flex-shrink-0 font-mono">
                    {{ $lab->enrollments_count }} enrolled
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
