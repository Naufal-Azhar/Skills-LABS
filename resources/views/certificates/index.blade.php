@extends('layouts.app')
@section('title', 'Sertifikat Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <div class="section-tag">Pencapaian</div>
        <h1 class="font-display text-3xl font-extrabold text-sl-text mb-2">Sertifikat Saya</h1>
        <p class="text-sl-text-2">Sertifikat digital yang kamu dapatkan setelah menyelesaikan lab.</p>
    </div>

    @if($certificates->isEmpty())
        <div class="sl-card p-12 text-center">
            <div class="w-20 h-20 bg-sl-yellow-dim border border-sl-yellow rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-sl-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <h3 class="font-display text-xl font-bold text-sl-text mb-2">Belum ada sertifikat</h3>
            <p class="text-sl-text-2 mb-6 max-w-sm mx-auto">Selesaikan lab untuk mendapatkan sertifikat digitalmu yang bisa diverifikasi!</p>
            <a href="{{ route('labs.index') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Mulai Lab Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($certificates as $cert)
            <div class="sl-card overflow-hidden relative group hover:border-sl-yellow hover:shadow-glow-yellow transition-all duration-200">
                {{-- Top accent --}}
                <div class="h-0.5 bg-gradient-to-r from-sl-yellow to-sl-orange"></div>

                {{-- Background decoration --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-sl-yellow rounded-full blur-3xl opacity-5 pointer-events-none"></div>

                <div class="p-6 relative z-10">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-sl-text-muted text-xs font-mono uppercase tracking-widest mb-1">Sertifikat Penyelesaian</p>
                            <p class="text-sl-text-2 text-xs">Skills LABS — ITEBA</p>
                        </div>
                        <div class="w-10 h-10 bg-sl-yellow-dim border border-sl-yellow rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-sl-yellow" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Lab Info --}}
                    <h3 class="font-display font-bold text-sl-text text-lg mb-1 leading-tight">{{ $cert->lab->title }}</h3>
                    <p class="text-sl-text-2 text-sm mb-4">{{ $cert->lab->category->name }}</p>

                    {{-- Divider --}}
                    <div class="sl-divider"></div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs text-sl-text-muted mb-0.5">Diterbitkan</div>
                            <div class="text-sm font-semibold text-sl-text">{{ $cert->issued_at->format('d M Y') }}</div>
                            <div class="text-xs text-sl-text-muted font-mono mt-1">{{ $cert->certificate_code }}</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('certificates.verify', $cert->certificate_code) }}"
                               class="btn-secondary text-xs px-3 py-2">
                               Verifikasi
                            </a>
                            <a href="{{ route('certificates.download', $cert->certificate_code) }}"
                               class="btn-primary text-xs px-3 py-2">
                               Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="mt-6 sl-card p-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-sl-green-dim border border-sl-green-2 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-sl-green-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-sl-text-2 text-sm">
                Kamu sudah mendapatkan
                <span class="text-sl-green-2 font-bold">{{ $certificates->count() }} sertifikat</span>.
                Terus belajar untuk mendapatkan lebih banyak!
            </p>
            <a href="{{ route('labs.index') }}" class="btn-ghost text-xs ml-auto flex-shrink-0">Jelajahi Labs →</a>
        </div>
    @endif
</div>
@endsection
