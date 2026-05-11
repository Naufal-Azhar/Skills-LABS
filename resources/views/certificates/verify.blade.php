@extends('layouts.app')
@section('title', 'Verifikasi Sertifikat')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="text-center mb-8">
        <div class="text-5xl mb-3">🔍</div>
        <h1 class="text-2xl font-extrabold text-slate-900">Verifikasi Sertifikat</h1>
        <p class="text-slate-500 mt-1">Kode: <span class="font-mono font-bold text-blue-700">{{ $certificate->certificate_code }}</span></p>
    </div>

    <div class="bg-green-50 border-2 border-green-400 rounded-2xl p-6 mb-6 text-center">
        <div class="text-4xl mb-2">✅</div>
        <h2 class="text-xl font-bold text-green-800">Sertifikat VALID</h2>
        <p class="text-green-600 text-sm mt-1">Sertifikat ini asli dan diterbitkan oleh Skills LABS — ITEBA</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 space-y-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">NAMA</div>
                <div class="font-bold text-slate-900">{{ $certificate->user->name }}</div>
            </div>
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">NIM</div>
                <div class="font-bold text-slate-900 font-mono">{{ $certificate->user->nim }}</div>
            </div>
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">JURUSAN</div>
                <div class="font-bold text-slate-900">{{ $certificate->user->major?->name ?? '-' }}</div>
            </div>
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">INSTITUSI</div>
                <div class="font-bold text-slate-900">{{ $certificate->user->major?->faculty?->name ?? 'ITEBA' }}</div>
            </div>
            <div class="col-span-2">
                <div class="text-slate-500 text-xs font-medium mb-1">LAB YANG DISELESAIKAN</div>
                <div class="font-bold text-slate-900 text-lg">{{ $certificate->lab->title }}</div>
            </div>
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">KATEGORI</div>
                <div class="font-bold text-slate-900">{{ $certificate->lab->category->name }}</div>
            </div>
            <div>
                <div class="text-slate-500 text-xs font-medium mb-1">TANGGAL DITERBITKAN</div>
                <div class="font-bold text-slate-900">{{ $certificate->issued_at->format('d F Y') }}</div>
            </div>
        </div>
    </div>
    <p class="text-center text-xs text-slate-400 mt-6">
        Diterbitkan oleh Skills LABS — Institut Teknologi Batam (ITEBA) &copy; {{ date('Y') }}
    </p>
</div>
@endsection
