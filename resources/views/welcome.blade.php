@extends('layouts.app')
@section('title', 'Skills LABS — Hands-On Learning ITEBA')

@section('content')

{{-- ─── HERO ─── --}}
<section class="relative overflow-hidden bg-hero-dark min-h-[88vh] flex items-center">
    {{-- Dot pattern overlay --}}
    <div class="absolute inset-0 dot-bg opacity-40"></div>
    {{-- Red glow blob --}}
    <div class="absolute top-20 right-20 w-96 h-96 bg-sl-red rounded-full blur-3xl opacity-5 pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-64 h-64 bg-sl-purple rounded-full blur-3xl opacity-5 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Text --}}
            <div class="animate-fade-in-up">

                {{-- Section tag — typewriter --}}
                <div class="section-tag mb-6">
                    <span class="status-online"></span>
                    <span id="typewriter-tag" class="font-mono"></span><span class="terminal-cursor"></span>
                </div>

                {{-- Heading besar --}}
                <h1 class="font-display text-5xl lg:text-6xl font-extrabold text-sl-text leading-tight mb-4">
                    AYO UPGRADE<br>
                    <span class="text-gradient-red">SKILL MU</span><br>
                    <span class="text-sl-text text-4xl lg:text-5xl">DENGAN PEMBELAJARAN</span><br>
                    <span class="text-gradient-red text-4xl lg:text-5xl">PRAKTIK</span>
                </h1>

                {{-- Sub heading --}}
                <p class="text-sl-text-2 text-lg mb-3 leading-relaxed max-w-lg">
                    Platform belajar praktik langsung untuk mahasiswa ITEBA. Akses labs teknologi, kerjakan latihan, dan dapatkan sertifikat digital.
                </p>
                <p class="text-sl-text-muted text-base mb-8 italic">
                    <span class="text-sl-green-2 font-semibold not-italic">Your future is waiting.</span>
                </p>

                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="{{ route('register') }}" class="btn-primary px-8 py-3.5 text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Mulai Belajar Gratis
                    </a>
                    <a href="{{ route('labs.index') }}" class="btn-secondary px-8 py-3.5 text-base">
                        Lihat Katalog Labs
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Mini stats --}}
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-sl-green-2 font-bold text-xl">{{ $stats['labs'] }}+</span>
                        <span class="text-sl-text-muted">Labs</span>
                    </div>
                    <div class="w-px h-6 bg-sl-border"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-sl-green-2 font-bold text-xl">{{ $stats['modules'] }}+</span>
                        <span class="text-sl-text-muted">Modul</span>
                    </div>
                    <div class="w-px h-6 bg-sl-border"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-sl-green-2 font-bold text-xl">{{ $stats['students'] }}+</span>
                        <span class="text-sl-text-muted">Mahasiswa</span>
                    </div>
                </div>
            </div>

            {{-- Right: Terminal Window --}}
            <div class="hidden lg:block animate-fade-in-up" style="animation-delay:0.2s">
                <div class="terminal shadow-glow-red border-sl-red/30">
                    <div class="terminal-header">
                        <span class="terminal-dot bg-red-500"></span>
                        <span class="terminal-dot bg-yellow-500"></span>
                        <span class="terminal-dot bg-green-500"></span>
                        <span class="text-sl-text-muted text-xs ml-2 font-mono">skills-labs ~ terminal</span>
                    </div>
                    <div class="terminal-body space-y-2 min-h-[220px]">
                        <div><span class="terminal-prompt">student@iteba</span><span class="text-sl-text-2">:~$</span> <span class="text-sl-text">python3 enroll.py</span></div>
                        <div class="terminal-comment"># Connecting to Skills LABS...</div>
                        <div class="text-sl-green-2">✓ Authenticated: Mahasiswa ITEBA</div>
                        <div class="terminal-comment"># Loading available labs...</div>
                        <div class="text-sl-text">
                            <span class="text-sl-blue">[INFO]</span> Found <span class="text-sl-yellow">{{ $stats['labs'] }}</span> labs available
                        </div>
                        <div class="text-sl-text">
                            <span class="text-sl-blue">[INFO]</span> Categories: <span class="text-sl-purple">6</span> topics
                        </div>
                        <div class="text-sl-green-2">✓ Enrollment: FREE (included in UKT)</div>
                        <div class="text-sl-text">
                            <span class="text-sl-blue">[INFO]</span> Certificates: <span class="text-sl-yellow">digital, verified</span>
                        </div>
                        <div class="mt-2">
                            <span class="terminal-prompt">student@iteba</span><span class="text-sl-text-2">:~$</span>
                            <span class="terminal-cursor"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ─── MARQUEE / RUNNING TEXT ─── --}}
<div class="bg-sl-red overflow-hidden py-3 border-y border-sl-red-dark relative">
    <div class="marquee-track flex items-center gap-0 whitespace-nowrap">
        @php
        $items = [
            '⚡ Hands-On Learning',
            '🎓 Sertifikat Digital',
            '💻 Praktik Langsung',
            '🔥 Gratis untuk Mahasiswa ITEBA',
            '🚀 Upgrade Skill Sekarang',
            '🏆 Raih Sertifikat',
            '🧪 Labs Teknologi Terkini',
            '📡 IoT & Embedded Systems',
            '🤖 AI & Data Science',
            '🌐 Web Development',
        ];
        @endphp
        {{-- Duplikat 3x agar seamless --}}
        @for($r = 0; $r < 3; $r++)
            @foreach($items as $item)
            <span class="inline-flex items-center gap-2 text-white font-bold text-sm px-6 font-mono">
                {{ $item }}
                <span class="text-white/40 mx-2">|</span>
            </span>
            @endforeach
        @endfor
    </div>
</div>

{{-- ─── STATS BAR ─── --}}
<section class="bg-sl-surface border-y border-sl-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach([
                ['val' => $stats['labs'],     'label' => 'Hands-On Labs',    'color' => 'text-sl-red'],
                ['val' => $stats['students'], 'label' => 'Mahasiswa Aktif',  'color' => 'text-sl-green-2'],
                ['val' => $stats['modules'],  'label' => 'Modul Tersedia',   'color' => 'text-sl-blue'],
                ['val' => $stats['certs'],    'label' => 'Sertifikat Terbit','color' => 'text-sl-yellow'],
            ] as $s)
            <div>
                <div class="font-display font-extrabold text-4xl {{ $s['color'] }} mb-1">{{ $s['val'] }}+</div>
                <div class="text-sl-text-muted text-sm">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── CATEGORIES ─── --}}
<section class="py-20 bg-sl-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="section-tag mx-auto w-fit">Kategori Labs</div>
            <h2 class="font-display text-3xl font-extrabold text-sl-text mb-3">Pilih Topik yang Kamu Inginkan</h2>
            <p class="text-sl-text-2 max-w-xl mx-auto">Dari pemrograman dasar hingga AI & IoT — semua tersedia untuk mahasiswa Teknik Komputer ITEBA.</p>
        </div>

        @php
        $catColors  = ['strip-red','strip-blue','strip-gray','strip-green','strip-purple','strip-yellow'];
        $catDetails = [
            'programming-fundamentals' => [
                'desc'   => 'Mulai perjalanan coding-mu dari nol. Lab ini dirancang khusus untuk mahasiswa yang belum pernah coding sama sekali, maupun yang ingin memperkuat fondasi pemrograman. Kamu akan belajar cara berpikir seperti programmer — memecah masalah, menulis logika, dan membangun program nyata step by step.',
                'topics' => [
                    '📦 Variabel, Tipe Data & Operator',
                    '🔀 Kondisi (if/else, switch)',
                    '🔁 Perulangan (for, while, do-while)',
                    '🧩 Fungsi & Rekursi',
                    '📚 Array & List',
                    '🏗️ Object-Oriented Programming (OOP)',
                    '🐛 Debugging & Error Handling',
                    '🐍 Python / Java / C++ Dasar',
                ],
            ],
            'web-development' => [
                'desc'   => 'Pelajari cara membangun website modern dari awal hingga siap deploy. Lab ini mencakup seluruh stack — dari tampilan frontend yang menarik hingga backend yang kuat. Kamu akan mengerjakan proyek nyata seperti landing page, sistem login, hingga REST API yang bisa langsung dipakai.',
                'topics' => [
                    '🎨 HTML5 Semantik & CSS3 Modern',
                    '✨ JavaScript ES6+ & DOM Manipulation',
                    '⚡ Tailwind CSS & Responsive Design',
                    '🐘 PHP & Laravel Framework',
                    '🔌 REST API & JSON',
                    '🗄️ MySQL & Eloquent ORM',
                    '🔐 Autentikasi & Keamanan Web',
                    '🚀 Deploy ke Server / Hosting',
                ],
            ],
            'networking-systems' => [
                'desc'   => 'Pahami cara kerja internet dan jaringan komputer dari dalam. Lab ini membekali kamu dengan skill jaringan yang dibutuhkan di dunia kerja — mulai dari konfigurasi router, analisis paket data, hingga keamanan jaringan. Cocok untuk yang ingin berkarir di bidang IT Infrastructure atau Network Engineer.',
                'topics' => [
                    '🌐 Model OSI & TCP/IP Stack',
                    '📡 IP Addressing & Subnetting',
                    '🔀 Routing & Switching (Static & Dynamic)',
                    '🐧 Linux Command Line & Shell Scripting',
                    '🔍 Wireshark & Packet Analysis',
                    '🔥 Firewall, VPN & Network Security',
                    '☁️ Cloud Networking Dasar',
                    '🖥️ Server Administration',
                ],
            ],
            'iot-embedded' => [
                'desc'   => 'Wujudkan ide perangkat pintar dengan tangan sendiri. Lab IoT mengajarkan kamu cara menghubungkan dunia fisik dengan dunia digital — dari sensor suhu, kontrol lampu otomatis, hingga sistem monitoring real-time yang bisa diakses lewat smartphone. Tidak perlu background elektronik yang dalam untuk memulai.',
                'topics' => [
                    '⚡ Arduino & ESP32/ESP8266',
                    '🌡️ Sensor (Suhu, Cahaya, Gerak, Jarak)',
                    '💡 Aktuator & Kontrol Motor',
                    '📶 WiFi, Bluetooth & LoRa',
                    '📨 Protokol MQTT & HTTP IoT',
                    '🍓 Raspberry Pi & Linux Embedded',
                    '📊 Dashboard IoT Real-time',
                    '🔋 Power Management & PCB Dasar',
                ],
            ],
            'ai-data-science' => [
                'desc'   => 'Masuki dunia kecerdasan buatan dan analisis data yang sedang booming. Lab ini membawa kamu dari dasar Python untuk data hingga membangun model machine learning yang bisa memprediksi, mengklasifikasi, dan mengenali pola. Skill yang paling dicari perusahaan teknologi saat ini.',
                'topics' => [
                    '🐍 Python untuk Data Science',
                    '📊 Pandas, NumPy & Matplotlib',
                    '🤖 Machine Learning (Supervised & Unsupervised)',
                    '🧠 Neural Network & Deep Learning Dasar',
                    '👁️ Computer Vision (OpenCV)',
                    '💬 Natural Language Processing (NLP)',
                    '📈 Data Visualization & Storytelling',
                    '🔬 Scikit-learn & TensorFlow',
                ],
            ],
            'database' => [
                'desc'   => 'Data adalah aset terpenting di era digital — dan kamu yang mengelolanya. Lab Database mengajarkan cara merancang, mengoptimalkan, dan mengamankan database yang digunakan jutaan aplikasi. Dari query SQL sederhana hingga arsitektur database skala besar, semua ada di sini.',
                'topics' => [
                    '📋 SQL Dasar: SELECT, INSERT, UPDATE, DELETE',
                    '🏗️ Desain Database & Normalisasi (1NF-3NF)',
                    '🔗 JOIN, Subquery & View',
                    '⚙️ Stored Procedure & Trigger',
                    '🚀 Query Optimization & Indexing',
                    '🍃 NoSQL: MongoDB & Redis',
                    '🔐 Database Security & Backup',
                    '☁️ Cloud Database (MySQL, PostgreSQL)',
                ],
            ],
        ];
        @endphp

        {{-- Category Grid dengan detail panel --}}
        <div x-data="{ active: null }" class="space-y-4">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($categories as $i => $cat)
                @php
                    $detail = $catDetails[$cat->slug] ?? ['desc' => 'Pelajari topik ini lebih dalam.', 'topics' => []];
                    $stripClass = $catColors[$i % count($catColors)];
                @endphp
                <button
                    @click="active = (active === '{{ $cat->slug }}') ? null : '{{ $cat->slug }}'"
                    :class="active === '{{ $cat->slug }}' ? 'border-sl-red shadow-glow-red -translate-y-1' : ''"
                    class="sl-card-hover p-5 text-center group {{ $stripClass }} w-full text-left transition-all duration-200">
                    <div class="text-3xl mb-3">{{ $cat->icon }}</div>
                    <div class="text-sm font-semibold text-sl-text group-hover:text-sl-red transition-colors leading-tight">{{ $cat->name }}</div>
                    <div class="text-xs text-sl-text-muted mt-1.5 font-mono">{{ $cat->labs_count }} labs</div>
                </button>
                @endforeach
            </div>

            {{-- Detail Panel — muncul di bawah grid --}}
            @foreach($categories as $i => $cat)
            @php $detail = $catDetails[$cat->slug] ?? ['desc' => 'Pelajari topik ini lebih dalam.', 'topics' => []]; @endphp
            <div
                x-show="active === '{{ $cat->slug }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="sl-card p-6 border-sl-red {{ $catColors[$i % count($catColors)] }}"
                style="display:none">
                <div class="flex flex-col gap-5">
                    {{-- Header --}}
                    <div class="flex items-center gap-4">
                        <div class="text-5xl flex-shrink-0">{{ $cat->icon }}</div>
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="font-display font-extrabold text-2xl text-sl-text">{{ $cat->name }}</h3>
                                <span class="badge-cat font-mono">{{ $cat->labs_count }} labs tersedia</span>
                            </div>
                            <p class="text-sl-text-2 text-sm leading-relaxed max-w-3xl">{{ $detail['desc'] }}</p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="sl-divider"></div>

                    {{-- Topics grid --}}
                    @if(!empty($detail['topics']))
                    <div>
                        <p class="text-xs text-sl-text-muted font-mono uppercase tracking-widest mb-3">
                            📚 Materi yang akan kamu pelajari:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                            @foreach($detail['topics'] as $topic)
                            <div class="bg-sl-bg border border-sl-border rounded-lg px-3 py-2.5 flex items-center gap-2">
                                <span class="text-sl-text-2 text-sm font-mono">{{ $topic }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Footer info --}}
                    <div class="flex items-center gap-4 pt-1 text-xs text-sl-text-muted font-mono border-t border-sl-border-sub">
                        <span class="flex items-center gap-1.5">
                            <span class="status-online"></span>
                            Labs aktif & terus diperbarui
                        </span>
                        <span>·</span>
                        <span>🎓 Sertifikat digital setelah selesai</span>
                        <span>·</span>
                        <span>✅ Gratis untuk mahasiswa ITEBA</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── FEATURED LABS ─── --}}
<section class="py-20 bg-sl-surface border-y border-sl-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <div class="section-tag">Featured</div>
                <h2 class="font-display text-3xl font-extrabold text-sl-text mb-2">Labs Unggulan</h2>
                <p class="text-sl-text-2">Lab-lab yang paling populer di Skills LABS.</p>
            </div>
            <a href="{{ route('labs.index') }}" class="btn-ghost hidden md:flex">Lihat semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @php
        $stripMap = ['programming-fundamentals'=>'strip-red','web-development'=>'strip-blue','networking-systems'=>'strip-gray','iot-embedded'=>'strip-green','ai-data-science'=>'strip-purple','database'=>'strip-yellow'];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredLabs as $lab)
            @php $strip = $stripMap[$lab->category->slug] ?? 'strip-red'; @endphp
            <a href="{{ route('labs.show', $lab->slug) }}" class="sl-card-hover flex flex-col group {{ $strip }}">
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
                    <h3 class="font-bold text-sl-text mb-2 group-hover:text-sl-red transition-colors leading-tight">{{ $lab->title }}</h3>
                    <p class="text-sl-text-2 text-sm line-clamp-2 flex-1 mb-4">{{ $lab->description }}</p>
                    <div class="flex items-center justify-between text-xs text-sl-text-muted pt-3 border-t border-sl-border font-mono">
                        <span>📝 {{ $lab->modules->count() ?? 0 }} Modul</span>
                        <span>⏱ {{ $lab->estimated_duration }}m</span>
                        <span>👁 {{ $lab->views }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── HOW IT WORKS ─── --}}
<section class="py-20 bg-sl-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="section-tag mx-auto w-fit">How it Works</div>
            <h2 class="font-display text-3xl font-extrabold text-sl-text mb-3">3 Langkah untuk Mulai</h2>
            <p class="text-sl-text-2 max-w-xl mx-auto">Tidak perlu bayar extra. Tidak perlu setup rumit. Langsung belajar.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
            <div class="hidden md:block absolute top-8 left-1/4 right-1/4 h-px bg-gradient-to-r from-sl-red/50 to-sl-red/50 via-sl-border"></div>
            @foreach([
                ['num'=>'01','title'=>'Daftar dengan NIM','desc'=>'Buat akun menggunakan NIM, nama, jurusan, dan fakultas ITEBA kamu. Gratis!','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['num'=>'02','title'=>'Pilih & Enroll Lab','desc'=>'Browse katalog labs sesuai jurusan dan skill yang ingin dipelajari. Klik enroll, langsung mulai.','icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                ['num'=>'03','title'=>'Selesaikan & Dapat Sertifikat','desc'=>'Kerjakan modul hands-on, tandai selesai, dan dapatkan sertifikat digital yang bisa diverifikasi.','icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ] as $step)
            <div class="sl-card p-6 text-center relative z-10">
                <div class="w-14 h-14 bg-sl-red-dim border border-sl-red rounded-xl flex items-center justify-center mx-auto mb-4 shadow-glow-red">
                    <svg class="w-6 h-6 text-sl-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                    </svg>
                </div>
                <div class="font-mono text-sl-red text-xs font-bold mb-2 tracking-widest">STEP {{ $step['num'] }}</div>
                <h3 class="font-bold text-sl-text text-lg mb-2">{{ $step['title'] }}</h3>
                <p class="text-sl-text-2 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── CTA ─── --}}
<section class="py-20 bg-sl-surface border-t border-sl-border relative overflow-hidden">
    <div class="absolute inset-0 dot-bg opacity-30"></div>
    <div class="absolute inset-0 border border-sl-red/10 m-6 rounded-2xl pointer-events-none"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 text-center">
        <div class="section-tag mx-auto w-fit mb-6">Siap Upgrade Skill?</div>
        <h2 class="font-display text-4xl font-extrabold text-sl-text mb-4">
            Bergabung dengan Mahasiswa<br><span class="text-gradient-red">ITEBA Lainnya</span>
        </h2>
        <p class="text-sl-text-2 text-lg mb-8">
            Daftar sekarang dan mulai belajar dengan labs hands-on yang dikurasi untuk mahasiswa Teknik Komputer ITEBA.
        </p>
        <a href="{{ route('register') }}" class="btn-primary px-10 py-4 text-base animate-glow-pulse">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Daftar Gratis Sekarang
        </a>
        <p class="text-sl-text-muted text-sm mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-sl-red hover:underline">Masuk di sini</a>
        </p>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ── Typewriter effect ──────────────────────────────────────────
    (function () {
        const phrases = [
            'Dari Kampus untuk Mahasiswa',
            'Upgrade Skill Mu Disini',
        ];
        const el = document.getElementById('typewriter-tag');
        if (!el) return;

        let phraseIdx = 0, charIdx = 0, deleting = false;

        function tick() {
            const current = phrases[phraseIdx];
            if (!deleting) {
                el.textContent = current.slice(0, ++charIdx);
                if (charIdx === current.length) {
                    deleting = true;
                    setTimeout(tick, 1800);
                    return;
                }
            } else {
                el.textContent = current.slice(0, --charIdx);
                if (charIdx === 0) {
                    deleting = false;
                    phraseIdx = (phraseIdx + 1) % phrases.length;
                }
            }
            setTimeout(tick, deleting ? 45 : 80);
        }
        tick();
    })();
</script>
@endpush
