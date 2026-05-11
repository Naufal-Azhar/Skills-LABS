<div align="center">

# 🧪 Skills LABS

### Platform Hands-On Learning untuk Mahasiswa ITEBA

**Belajar teknologi secara praktis, terstruktur, dan gratis — kapan saja, di mana saja.**

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

</div>

---

## 📖 Tentang Skills LABS

**Skills LABS** adalah platform web berbasis Laravel yang menyediakan materi pelatihan *hands-on* (praktik langsung) untuk mahasiswa **Institut Teknologi Batam (ITEBA)**. Platform ini hadir sebagai solusi atas tingginya biaya kursus teknologi di luar kampus — mahasiswa cukup mendaftar dengan NIM dan email kampus untuk mengakses seluruh materi labs secara **gratis**, karena sudah termasuk dalam UKT.

### 🎯 Tujuan Platform

| Masalah | Solusi |
|---------|--------|
| 💸 Kursus teknologi mahal (Udemy, Coursera, Dicoding) | ✅ Gratis untuk mahasiswa ITEBA |
| 📚 Materi kuliah terlalu teoritis | ✅ Hands-on labs step-by-step |
| 🏫 Akses lab fisik terbatas (waktu & kapasitas) | ✅ Akses 24/7 dari mana saja |
| 📂 Materi tersebar di berbagai sumber | ✅ Satu platform terpusat |
| 🏆 Tidak ada bukti kompetensi digital | ✅ Sertifikat digital yang bisa diverifikasi |

---

## ✨ Fitur Utama

### 👨‍🎓 Untuk Mahasiswa
- **🗂️ Katalog Labs** — Browse ratusan labs dengan filter kategori, level, dan pencarian
- **📋 Enrollment System** — Daftar ke lab yang diminati dengan satu klik
- **📖 Pembelajaran Modul** — Konten terstruktur: teks, video YouTube, contoh kode, dan checkpoint
- **📊 Progress Tracking** — Pantau kemajuan belajar secara real-time dengan progress bar
- **🏅 Sertifikat Digital** — Sertifikat PDF otomatis terbit saat lab 100% selesai
- **🔍 Verifikasi Sertifikat** — Kode unik untuk membuktikan keaslian sertifikat
- **👤 Profil Mahasiswa** — Kelola data diri, NIM, jurusan, dan semester

### 🛡️ Untuk Admin
- **📈 Dashboard Statistik** — Pantau total mahasiswa, labs, modul, dan sertifikat
- **⚙️ Manajemen Labs** — CRUD labs lengkap dengan pengaturan level, kategori, dan status
- **👥 Manajemen Mahasiswa** — Lihat daftar mahasiswa dan toggle status aktif/nonaktif

---

## 🖥️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| 🔧 Backend Framework | Laravel 10.x |
| 🐘 Runtime | PHP 8.1+ |
| 🎨 Frontend | Blade Templates + Tailwind CSS 3.x |
| ⚡ JavaScript | Alpine.js 3.x |
| 🏗️ Build Tool | Vite 5.x |
| 🗄️ Database | MySQL (via Laragon) |
| 🔐 Authentication | Laravel Breeze |
| 📄 PDF Generator | barryvdh/laravel-dompdf |
| 🎭 UI Theme | Dark Theme (TryHackMe-inspired) |

---

## 🚀 Cara Instalasi & Menjalankan

### Prasyarat

Pastikan sudah terinstall:
- [Laragon](https://laragon.org/) (atau XAMPP/Herd)
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/username/skills-labs.git
cd skills-labs
```

**2. Install dependencies PHP**
```bash
composer install
```

**3. Install dependencies JavaScript**
```bash
npm install
```

**4. Salin file environment**
```bash
cp .env.example .env
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Konfigurasi database**

Edit file `.env` dan sesuaikan:
```env
APP_NAME="Skills LABS"
APP_URL=http://skills-labs.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skills_labs
DB_USERNAME=root
DB_PASSWORD=
```

**7. Jalankan migrasi dan seeder**
```bash
php artisan migrate --seed
```

**8. Build assets frontend**
```bash
npm run build
```

**9. Jalankan development server** *(opsional, jika tidak pakai Laragon)*
```bash
php artisan serve
```

Akses aplikasi di: **http://skills-labs.test** atau **http://localhost:8000**

---

## 🗺️ Alur Penggunaan

### Sebagai Mahasiswa

```
1. 📝 Register  →  Isi nama, NIM, email, jurusan, semester, password
2. 🔑 Login     →  Masuk dengan email & password
3. 🏠 Dashboard →  Lihat progress, rekomendasi labs, dan sertifikat
4. 🔍 Browse    →  Cari lab di katalog (filter kategori, level, keyword)
5. 📌 Enroll    →  Klik "Enroll" di halaman detail lab
6. 📖 Belajar   →  Kerjakan modul satu per satu (video, teks, kode, checkpoint)
7. ✅ Selesaikan →  Klik "Tandai Selesai" di setiap modul
8. 🏅 Sertifikat →  Download PDF sertifikat saat lab 100% selesai
```

### Sebagai Admin

```
1. 🔑 Login dengan akun role admin
2. 📊 /admin    →  Lihat statistik keseluruhan platform
3. ⚙️ /admin/labs →  Tambah, edit, atau hapus labs
4. 👥 /admin/students →  Kelola data mahasiswa
```

---

## 📁 Struktur Proyek

```
skills-labs/
├── 📂 app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ← Controller admin panel
│   │   │   ├── Auth/           ← Autentikasi (Breeze)
│   │   │   ├── LabController.php
│   │   │   ├── ModuleController.php
│   │   │   ├── EnrollmentController.php
│   │   │   ├── CertificateController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/                 ← 9 Eloquent models
│       ├── User.php
│       ├── Lab.php
│       ├── LabModule.php
│       ├── LabCategory.php
│       ├── Enrollment.php
│       ├── ModuleProgress.php
│       ├── Certificate.php
│       ├── Faculty.php
│       └── Major.php
├── 📂 database/
│   ├── migrations/             ← Schema database
│   └── seeders/                ← Data awal (demo content)
├── 📂 resources/views/         ← Blade templates
│   ├── layouts/
│   ├── dashboard/
│   ├── labs/
│   ├── certificates/
│   └── admin/
└── 📂 routes/
    └── web.php                 ← Semua route aplikasi
```

---

## 🗄️ Skema Database

```
faculties ──< majors ──< users ──< enrollments ──> labs
                                       │
                              module_progresses ──> lab_modules
                                       │
                                  certificates ──> labs

lab_categories ──< labs ──< lab_modules
```

**9 tabel utama:** `faculties`, `majors`, `users`, `lab_categories`, `labs`, `lab_modules`, `enrollments`, `module_progresses`, `certificates`

---

## 🌐 Daftar Route

| Method | Route | Deskripsi |
|--------|-------|-----------|
| `GET` | `/` | Landing page |
| `GET` | `/labs` | Katalog labs (publik) |
| `GET` | `/labs/{slug}` | Detail lab |
| `GET` | `/verify-certificate/{code}` | Verifikasi sertifikat (publik) |
| `GET` | `/dashboard` | Dashboard mahasiswa 🔒 |
| `POST` | `/labs/{slug}/enroll` | Enroll ke lab 🔒 |
| `GET` | `/labs/{slug}/modules/{id}` | Halaman modul 🔒 |
| `POST` | `/modules/{id}/complete` | Tandai modul selesai 🔒 |
| `GET` | `/my-progress` | Progress semua lab 🔒 |
| `GET` | `/my-certificates` | Daftar sertifikat 🔒 |
| `GET` | `/certificates/{code}/download` | Download PDF 🔒 |
| `GET` | `/admin` | Admin dashboard 🔒👑 |
| `GET` | `/admin/labs` | Manajemen labs 🔒👑 |
| `GET` | `/admin/students` | Manajemen mahasiswa 🔒👑 |

> 🔒 = Butuh login | 👑 = Butuh role admin

---

## 🎨 Design System

Platform menggunakan **dark theme** terinspirasi dari TryHackMe:

| Elemen | Warna |
|--------|-------|
| Background | `#0D1117` |
| Card | `#1A2035` |
| Primary (merah) | `#FF4655` |
| Success (hijau) | `#20C997` |
| Warning (kuning) | `#FFD60A` |
| Info (biru) | `#58A6FF` |

**Font:** Plus Jakarta Sans (heading) · Inter (body) · JetBrains Mono (kode)

---

## 📊 Kategori Labs

| Kategori | Contoh Topik |
|----------|-------------|
| 🖥️ Programming Fundamentals | Algoritma C, Python, OOP, Struktur Data |
| 🌐 Web Development | HTML/CSS, JavaScript, PHP, Laravel, REST API |
| 🔧 Networking & Systems | Jaringan Komputer, Linux CLI, Cisco, Keamanan |
| 🤖 IoT & Embedded Systems | Arduino, Raspberry Pi, Sensor, Smart Home |
| 🧠 AI & Data Science | Machine Learning, Computer Vision, Edge AI |
| 🗄️ Database | SQL, MySQL, NoSQL, Database Design |

---

## 🏆 Alur Sertifikat

```
Enroll Lab → Kerjakan Modul → Tandai Selesai → Progress 100% → 🎉 Sertifikat Terbit
                                                                        ↓
                                                              Download PDF
                                                                        ↓
                                                         Verifikasi via /verify-certificate/{kode}
```

Setiap sertifikat memiliki **kode unik** yang bisa diverifikasi secara publik tanpa perlu login.

---

## 👥 Role & Akses

| Role | Akses |
|------|-------|
| 🌐 Guest | Landing page, katalog labs (view only), verifikasi sertifikat |
| 👨‍🎓 Student | Dashboard, enroll, belajar modul, download sertifikat, edit profil |
| 👑 Admin | Semua fitur student + manajemen labs & mahasiswa |

---

## 📋 Informasi Proyek

> Proyek ini dibuat sebagai **Tugas UAS** mata kuliah Pemrograman Web di **Institut Teknologi Batam (ITEBA)**.
>
> **Konsep:** Tech Startup — Platform digital yang menjawab kebutuhan mahasiswa akan akses materi praktikum teknologi yang terjangkau dan terstruktur.

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).

---

<div align="center">

Dibuat dengan ❤️ untuk mahasiswa ITEBA

**[Institut Teknologi Batam](https://iteba.ac.id)**

</div>
