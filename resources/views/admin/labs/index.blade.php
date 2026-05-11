@extends('layouts.admin')
@section('title', 'Manajemen Labs')
@section('page-title', 'Manajemen Labs')

@section('content')
<div class="flex justify-between items-center mb-5">
    <p class="text-sl-text-muted text-sm font-mono">Total: <span class="text-sl-text font-bold">{{ $labs->total() }}</span> labs</p>
    <a href="{{ route('admin.labs.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Lab
    </a>
</div>

<div class="sl-card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-sl-surface border-b border-sl-border">
            <tr>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Lab</th>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden md:table-cell">Kategori</th>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden lg:table-cell">Level</th>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden lg:table-cell">Enrolled</th>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Status</th>
                <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-sl-border-sub">
            @foreach($labs as $lab)
            <tr class="hover:bg-sl-surface transition-colors">
                <td class="px-5 py-4">
                    <div class="font-semibold text-sl-text truncate max-w-xs">{{ $lab->title }}</div>
                    <div class="text-xs text-sl-text-muted font-mono">{{ $lab->estimated_duration }} menit</div>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <span class="text-sl-text-2 text-sm">{{ $lab->category->icon }} {{ $lab->category->name }}</span>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell">
                    <span class="
                        @if($lab->level === 'beginner') badge-beginner
                        @elseif($lab->level === 'intermediate') badge-intermediate
                        @else badge-advanced @endif">
                        {{ $lab->level_label }}
                    </span>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell text-sl-text-2 font-mono text-sm">
                    {{ $lab->enrollments_count }}
                </td>
                <td class="px-5 py-4">
                    <span class="text-xs font-bold px-2 py-0.5 rounded border
                        {{ $lab->is_active
                            ? 'bg-sl-green-dim text-sl-green-2 border-sl-green-2'
                            : 'bg-sl-red-dim text-sl-red border-sl-red' }}">
                        {{ $lab->is_active ? 'Aktif' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.labs.edit', $lab) }}"
                           class="text-sl-blue hover:underline text-xs font-semibold">Edit</a>
                        <form method="POST" action="{{ route('admin.labs.destroy', $lab) }}"
                              onsubmit="return confirm('Hapus lab ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sl-red hover:underline text-xs font-semibold">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-sl-border">
        {{ $labs->links() }}
    </div>
</div>
@endsection
