@extends('layouts.admin')
@section('title', 'Manajemen Mahasiswa')
@section('page-title', 'Manajemen Mahasiswa')

@section('content')

{{-- Search --}}
<form method="GET" action="{{ route('admin.students.index') }}"
      class="sl-card p-4 mb-5 flex gap-3">
    <input type="text" name="search" value="{{ request('search') }}"
           class="input-dark flex-1" placeholder="Cari nama, NIM, atau email...">
    <button type="submit" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Cari
    </button>
    @if(request('search'))
        <a href="{{ route('admin.students.index') }}" class="btn-secondary">Reset</a>
    @endif
</form>

<div class="sl-card overflow-hidden">
    <div class="px-5 py-4 border-b border-sl-border flex items-center justify-between">
        <h3 class="font-bold text-sl-text text-sm">
            Total: <span class="text-sl-red font-mono">{{ $students->total() }}</span> mahasiswa
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-sl-surface border-b border-sl-border">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Mahasiswa</th>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden md:table-cell">NIM</th>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden lg:table-cell">Jurusan</th>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider hidden lg:table-cell">Semester</th>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3 font-semibold text-sl-text-2 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sl-border-sub">
                @forelse($students as $student)
                <tr class="hover:bg-sl-surface transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $student->avatar_url }}" alt=""
                                 class="w-8 h-8 rounded-full border border-sl-border flex-shrink-0">
                            <div>
                                <div class="font-semibold text-sl-text">{{ $student->name }}</div>
                                <div class="text-xs text-sl-text-muted">{{ $student->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell font-mono text-sl-text-2 text-xs">{{ $student->nim }}</td>
                    <td class="px-5 py-4 hidden lg:table-cell text-sl-text-2 text-xs">{{ $student->major?->name ?? '-' }}</td>
                    <td class="px-5 py-4 hidden lg:table-cell text-sl-text-2 text-xs font-mono">
                        {{ $student->semester ? 'Sem. ' . $student->semester : '-' }}
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs font-bold px-2 py-0.5 rounded border
                            {{ $student->is_active
                                ? 'bg-sl-green-dim text-sl-green-2 border-sl-green-2'
                                : 'bg-sl-red-dim text-sl-red border-sl-red' }}">
                            {{ $student->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <form method="POST" action="{{ route('admin.students.toggle', $student) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-xs font-semibold transition-colors
                                           {{ $student->is_active ? 'text-sl-red hover:underline' : 'text-sl-green-2 hover:underline' }}">
                                {{ $student->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-sl-text-muted">
                        Tidak ada mahasiswa ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-sl-border">
        {{ $students->withQueryString()->links() }}
    </div>
</div>
@endsection
