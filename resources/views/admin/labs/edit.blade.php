@extends('layouts.admin')
@section('title', 'Edit Lab')
@section('page-title', 'Edit Lab: ' . $lab->title)

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.labs.index') }}" class="btn-ghost mb-5 inline-flex">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Labs
    </a>

    <div class="sl-card p-6">
        <form method="POST" action="{{ route('admin.labs.update', $lab) }}" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="label-dark">Judul Lab <span class="text-sl-red">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $lab->title) }}" required
                           class="input-dark">
                </div>

                <div>
                    <label class="label-dark">Kategori <span class="text-sl-red">*</span></label>
                    <select name="lab_category_id" required class="select-dark">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('lab_category_id', $lab->lab_category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->icon }} {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-dark">Jurusan</label>
                    <select name="major_id" class="select-dark">
                        <option value="">-- Semua Jurusan --</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->id }}"
                                {{ old('major_id', $lab->major_id) == $major->id ? 'selected' : '' }}>
                                {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label-dark">Level</label>
                    <select name="level" class="select-dark">
                        <option value="beginner"     {{ old('level', $lab->level) == 'beginner'     ? 'selected' : '' }}>🟢 Pemula</option>
                        <option value="intermediate" {{ old('level', $lab->level) == 'intermediate' ? 'selected' : '' }}>🟡 Menengah</option>
                        <option value="advanced"     {{ old('level', $lab->level) == 'advanced'     ? 'selected' : '' }}>🔴 Lanjutan</option>
                    </select>
                </div>

                <div>
                    <label class="label-dark">Estimasi Durasi (menit)</label>
                    <input type="number" name="estimated_duration"
                           value="{{ old('estimated_duration', $lab->estimated_duration) }}" min="1"
                           class="input-dark">
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark">Deskripsi <span class="text-sl-red">*</span></label>
                    <textarea name="description" rows="3" required
                              class="input-dark">{{ old('description', $lab->description) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark">Tujuan Pembelajaran</label>
                    <textarea name="objective" rows="3"
                              class="input-dark">{{ old('objective', $lab->objective) }}</textarea>
                </div>

                <div>
                    <label class="label-dark">Prerequisite</label>
                    <textarea name="prerequisites" rows="2"
                              class="input-dark">{{ old('prerequisites', $lab->prerequisites) }}</textarea>
                </div>

                <div>
                    <label class="label-dark">Tools yang Dibutuhkan</label>
                    <textarea name="tools_needed" rows="2"
                              class="input-dark">{{ old('tools_needed', $lab->tools_needed) }}</textarea>
                </div>

                <div class="md:col-span-2 flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $lab->is_active) ? 'checked' : '' }}
                               class="rounded bg-sl-surface border-sl-border text-sl-red focus:ring-sl-red focus:ring-offset-sl-bg">
                        <span class="text-sm text-sl-text-2 font-medium">Aktifkan Lab</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $lab->is_featured) ? 'checked' : '' }}
                               class="rounded bg-sl-surface border-sl-border text-sl-red focus:ring-sl-red focus:ring-offset-sl-bg">
                        <span class="text-sm text-sl-text-2 font-medium">Unggulan (Landing Page)</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-sl-border">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Update Lab
                </button>
                <a href="{{ route('admin.labs.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
