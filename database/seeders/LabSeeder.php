<?php

namespace Database\Seeders;

use App\Models\Lab;
use App\Models\LabCategory;
use App\Models\LabModule;
use App\Models\Major;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    public function run(): void
    {
        $tk = Major::where("code", "TK")->first();
        $tif = Major::where("code", "TIF")->first();

        $catProg = LabCategory::where(
            "slug",
            "programming-fundamentals",
        )->first();
        $catWeb = LabCategory::where("slug", "web-development")->first();
        $catNet = LabCategory::where("slug", "networking-systems")->first();
        $catIot = LabCategory::where("slug", "iot-embedded")->first();
        $catAi = LabCategory::where("slug", "ai-data-science")->first();
        $catDb = LabCategory::where("slug", "database")->first();

        $labs = [
            // --- Programming Fundamentals ---
            [
                "lab_category_id" => $catProg->id,
                "major_id" => $tk->id,
                "title" => "Python untuk Pemula",
                "slug" => "python-untuk-pemula",
                "description" =>
                    "Lab ini memperkenalkan bahasa pemrograman Python dari nol. Kamu akan belajar variabel, tipe data, kondisi, perulangan, dan fungsi melalui praktik langsung.",
                "objective" =>
                    "1. Memahami sintaks dasar Python\n2. Membuat program sederhana\n3. Menggunakan fungsi bawaan Python\n4. Menyelesaikan latihan hands-on",
                "prerequisites" =>
                    "Tidak ada prerequisite. Lab ini untuk pemula.",
                "tools_needed" =>
                    "- Python 3.x (https://python.org)\n- VS Code atau IDLE\n- Terminal / Command Prompt",
                "level" => "beginner",
                "estimated_duration" => 120,
                "is_active" => true,
                "is_featured" => true,
                "modules" => [
                    [
                        "title" => "Pengenalan Python & Setup Environment",
                        "content" =>
                            "## Apa itu Python?\n\nPython adalah bahasa pemrograman tingkat tinggi yang mudah dibaca dan dipelajari. Python digunakan untuk web development, data science, AI, automation, dan banyak lagi.\n\n## Kenapa Python?\n- Sintaks yang bersih dan mudah dibaca\n- Komunitas yang besar\n- Library yang sangat banyak\n- Digunakan di industri top dunia\n\n## Cara Install Python\n1. Buka https://python.org/downloads\n2. Download Python 3.x versi terbaru\n3. Install dengan centang **Add Python to PATH**\n4. Verifikasi dengan menjalankan `python --version` di terminal",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=PXMJ6eTirHg",
                        "reference_url" =>
                            "https://www.freecodecamp.org/learn/scientific-computing-with-python/",
                        "code_example" =>
                            "# Program Python pertama kamu!\nprint(\"Halo, Skills LABS!\")\n\n# Variabel dan tipe data\nnama = \"Mahasiswa ITEBA\"\nnim  = 12345\nipk  = 3.75\naktif = True\n\nprint(f\"Nama : {nama}\")\nprint(f\"NIM  : {nim}\")\nprint(f\"IPK  : {ipk}\")\nprint(f\"Aktif: {aktif}\")",
                        "code_language" => "python",
                        "checkpoint" =>
                            "1. Install Python dan cek versinya di terminal\n2. Jalankan program 'Hello World' pertamamu\n3. Buat variabel untuk menyimpan nama, NIM, dan jurusan kamu\n4. Tampilkan variabel tersebut menggunakan print()",
                        "order" => 1,
                        "estimated_duration" => 20,
                    ],
                    [
                        "title" => "Kondisi dan Perulangan",
                        "content" =>
                            "## Kondisi (if / elif / else)\n\nKondisi digunakan untuk membuat keputusan dalam program.\n\n## Perulangan (for / while)\n\nPerulangan digunakan untuk mengeksekusi blok kode berulang kali.",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=PqFKRqpHrjw",
                        "reference_url" =>
                            "https://www.w3schools.com/python/python_conditions.asp",
                        "code_example" =>
                            "# Contoh kondisi\nnilai = 85\n\nif nilai >= 90:\n    print(\"Grade: A\")\nelif nilai >= 80:\n    print(\"Grade: B\")\nelif nilai >= 70:\n    print(\"Grade: C\")\nelse:\n    print(\"Grade: D\")\n\n# Contoh perulangan for\nprint(\"\\nAngka 1 sampai 5:\")\nfor i in range(1, 6):\n    print(i)\n\n# Perulangan while\nprint(\"\\nHitung mundur:\")\nx = 5\nwhile x > 0:\n    print(x)\n    x -= 1\nprint(\"Selesai!\")",
                        "code_language" => "python",
                        "checkpoint" =>
                            "1. Buat program yang menerima input nilai mahasiswa dan menampilkan grade (A/B/C/D/E)\n2. Buat program untuk menghitung jumlah bilangan ganjil dari 1-100\n3. Gunakan while loop untuk membuat game tebak angka sederhana",
                        "order" => 2,
                        "estimated_duration" => 25,
                    ],
                    [
                        "title" => "Fungsi dan Modularitas",
                        "content" =>
                            "## Fungsi (Function)\n\nFungsi adalah blok kode yang dapat dipanggil berkali-kali. Fungsi membuat kode lebih terorganisir dan dapat digunakan kembali (reusable).",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=9Os0o3wzS_I",
                        "reference_url" =>
                            "https://www.freecodecamp.org/learn/scientific-computing-with-python/#python-for-everybody",
                        "code_example" =>
                            "# Definisi fungsi\ndef hitung_luas_persegi(sisi):\n    \"\"\"Menghitung luas persegi\"\"\"\n    return sisi * sisi\n\ndef hitung_luas_lingkaran(r):\n    \"\"\"Menghitung luas lingkaran\"\"\"\n    import math\n    return math.pi * r ** 2\n\ndef sapa_mahasiswa(nama, nim, jurusan=\"Teknik Komputer\"):\n    \"\"\"Menyapa mahasiswa\"\"\"\n    return f\"Halo {nama} ({nim}) dari {jurusan}!\"\n\n# Memanggil fungsi\nprint(hitung_luas_persegi(5))\nprint(f\"{hitung_luas_lingkaran(7):.2f}\")\nprint(sapa_mahasiswa(\"Budi\", \"TK2024001\"))",
                        "code_language" => "python",
                        "checkpoint" =>
                            "1. Buat fungsi untuk menghitung nilai rata-rata dari list nilai mahasiswa\n2. Buat fungsi rekursif untuk menghitung faktorial\n3. Buat fungsi yang menerima *args untuk menjumlahkan banyak angka",
                        "order" => 3,
                        "estimated_duration" => 25,
                    ],
                ],
            ],

            // --- Web Development ---
            [
                "lab_category_id" => $catWeb->id,
                "major_id" => $tif->id,
                "title" => "HTML & CSS Dasar",
                "slug" => "html-css-dasar",
                "description" =>
                    "Pelajari fondasi web development dengan HTML untuk struktur dan CSS untuk tampilan. Lab ini menggunakan pendekatan hands-on membangun halaman web nyata.",
                "objective" =>
                    "1. Memahami struktur dokumen HTML5\n2. Menguasai elemen-elemen HTML penting\n3. Menggunakan CSS untuk styling\n4. Membuat halaman web responsif sederhana",
                "prerequisites" => "Tidak ada prerequisite.",
                "tools_needed" =>
                    "- VS Code (https://code.visualstudio.com)\n- Browser modern (Chrome/Firefox)\n- Extension: Live Server (VS Code)",
                "level" => "beginner",
                "estimated_duration" => 90,
                "is_active" => true,
                "is_featured" => true,
                "modules" => [
                    [
                        "title" => "Struktur Dasar HTML5",
                        "content" =>
                            "## HTML adalah Fondasi Web\n\nHTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. Setiap halaman web yang kamu lihat di browser dibangun dengan HTML.\n\n## Struktur Dokumen HTML5\n\nSetiap dokumen HTML memiliki struktur dasar yang harus diikuti.",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=mbeT8mpmtHA",
                        "reference_url" =>
                            "https://developer.mozilla.org/en-US/docs/Learn/HTML/Introduction_to_HTML",
                        "code_example" =>
                            "<!DOCTYPE html>\n<html lang=\"id\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Halaman Pertamaku</title>\n</head>\n<body>\n    <header>\n        <h1>Selamat Datang di Skills LABS</h1>\n        <nav>\n            <a href=\"#\">Home</a> |\n            <a href=\"#\">Labs</a> |\n            <a href=\"#\">Tentang</a>\n        </nav>\n    </header>\n\n    <main>\n        <h2>Apa itu Skills LABS?</h2>\n        <p>Skills LABS adalah platform belajar hands-on untuk mahasiswa ITEBA.</p>\n\n        <ul>\n            <li>Gratis untuk mahasiswa ITEBA</li>\n            <li>Materi hands-on & praktik</li>\n            <li>Sertifikat digital</li>\n        </ul>\n    </main>\n\n    <footer>\n        <p>&copy; 2024 Skills LABS - ITEBA</p>\n    </footer>\n</body>\n</html>",
                        "code_language" => "html",
                        "checkpoint" =>
                            "1. Buat file index.html dengan struktur HTML5 yang benar\n2. Tambahkan heading (h1-h3), paragraf, dan list\n3. Buat navigasi dengan tag <nav> dan <a>\n4. Tambahkan gambar menggunakan tag <img>",
                        "order" => 1,
                        "estimated_duration" => 20,
                    ],
                    [
                        "title" => "CSS Styling & Selectors",
                        "content" =>
                            "## CSS - Cascading Style Sheets\n\nCSS digunakan untuk mengatur tampilan elemen HTML: warna, font, ukuran, layout, dan animasi.",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=wRNinF7YQqQ",
                        "reference_url" =>
                            "https://developer.mozilla.org/en-US/docs/Learn/CSS/First_steps",
                        "code_example" =>
                            "/* Reset dan variabel CSS */\n* {\n    margin: 0;\n    padding: 0;\n    box-sizing: border-box;\n}\n\n:root {\n    --primary: #1E40AF;\n    --accent: #06B6D4;\n    --text: #1F2937;\n}\n\n/* Styling body */\nbody {\n    font-family: 'Inter', sans-serif;\n    color: var(--text);\n    background: #F8FAFC;\n}\n\n/* Styling header */\nheader {\n    background: var(--primary);\n    color: white;\n    padding: 1rem 2rem;\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n}\n\n/* Card component */\n.card {\n    background: white;\n    border-radius: 8px;\n    padding: 1.5rem;\n    box-shadow: 0 2px 8px rgba(0,0,0,0.1);\n    transition: transform 0.2s;\n}\n\n.card:hover {\n    transform: translateY(-4px);\n}",
                        "code_language" => "css",
                        "checkpoint" =>
                            "1. Hubungkan file CSS eksternal ke HTML\n2. Ubah warna background dan font halaman\n3. Buat card component dengan CSS\n4. Tambahkan hover effect pada tombol",
                        "order" => 2,
                        "estimated_duration" => 25,
                    ],
                ],
            ],

            // --- Networking ---
            [
                "lab_category_id" => $catNet->id,
                "major_id" => $tk->id,
                "title" => "Linux Command Line Fundamentals",
                "slug" => "linux-command-line",
                "description" =>
                    "Kuasai perintah-perintah dasar Linux yang wajib diketahui oleh setiap engineer. Lab ini mencakup navigasi filesystem, manajemen file, dan perintah-perintah esensial.",
                "objective" =>
                    "1. Navigasi filesystem Linux\n2. Manajemen file dan direktori\n3. Permission dan ownership\n4. Pipe dan redirect\n5. Text processing",
                "prerequisites" => "Tidak ada prerequisite.",
                "tools_needed" =>
                    "- Linux (Ubuntu/Debian) atau WSL di Windows\n- Terminal emulator",
                "level" => "beginner",
                "estimated_duration" => 90,
                "is_active" => true,
                "is_featured" => false,
                "modules" => [
                    [
                        "title" => "Navigasi Filesystem",
                        "content" =>
                            "## Filesystem Linux\n\nLinux mengorganisasi file dalam struktur pohon (tree) yang dimulai dari root `/`. Memahami cara navigasi adalah skill fundamental seorang engineer.",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=oxuRxtrO2Ag",
                        "reference_url" =>
                            "https://linuxjourney.com/lesson/the-shell",
                        "code_example" =>
                            "# Perintah navigasi dasar Linux\n\n# Lihat direktori saat ini\npwd\n\n# List isi direktori\nls\nls -la          # Tampilkan semua file termasuk hidden, dengan detail\nls -lh          # Human-readable file sizes\n\n# Pindah direktori\ncd /home        # Ke direktori absolut\ncd Documents    # Ke subdirektori\ncd ..           # Satu level ke atas\ncd ~            # Ke home directory\ncd -            # Ke direktori sebelumnya\n\n# Buat direktori\nmkdir projects\nmkdir -p projects/web/html   # Buat nested directories\n\n# Hapus direktori\nrmdir direktori_kosong\nrm -rf direktori_berisi  # Hati-hati!\n\n# Lihat struktur direktori\ntree\ntree -L 2       # Tampilkan 2 level",
                        "code_language" => "bash",
                        "checkpoint" =>
                            "1. Navigasi ke /etc dan tampilkan isinya\n2. Buat struktur direktori: projects/skills-labs/src\n3. Gunakan `ls -la` dan jelaskan setiap kolom yang muncul\n4. Coba kombinasi `cd` untuk kembali ke home directory",
                        "order" => 1,
                        "estimated_duration" => 20,
                    ],
                ],
            ],

            // --- IoT ---
            [
                "lab_category_id" => $catIot->id,
                "major_id" => $tk->id,
                "title" => "Arduino Fundamentals",
                "slug" => "arduino-fundamentals",
                "description" =>
                    "Mulai perjalanan IoT kamu dengan Arduino. Lab ini mengajarkan pemrograman mikrokontroler, kontrol LED, pembacaan sensor, dan komunikasi serial.",
                "objective" =>
                    "1. Memahami hardware Arduino\n2. Menggunakan Arduino IDE\n3. Kontrol digital output (LED)\n4. Membaca analog input (sensor)\n5. Komunikasi serial",
                "prerequisites" =>
                    "Pemahaman dasar pemrograman (C/Python) sangat membantu.",
                "tools_needed" =>
                    "- Arduino Uno atau Nano\n- Breadboard\n- LED, resistor, kabel jumper\n- Arduino IDE (https://arduino.cc/en/software)\n- Kabel USB",
                "level" => "beginner",
                "estimated_duration" => 150,
                "is_active" => true,
                "is_featured" => true,
                "modules" => [
                    [
                        "title" => "Pengenalan Arduino & Blink LED",
                        "content" =>
                            "## Apa itu Arduino?\n\nArduino adalah platform elektronik open-source yang terdiri dari hardware (board mikrokontroler) dan software (Arduino IDE). Arduino sangat populer untuk proyek IoT, robotika, dan otomasi.\n\n## Arduino Uno - Board Paling Populer\n\nArduino Uno menggunakan mikrokontroler ATmega328P dengan:\n- 14 digital I/O pins\n- 6 analog input pins\n- 6 PWM pins\n- Clock speed 16 MHz\n- Flash memory 32KB",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=fJWR7dBuc18",
                        "reference_url" =>
                            "https://www.arduino.cc/en/Tutorial/BuiltInExamples/Blink",
                        "code_example" =>
                            "// Program Blink - LED Berkedip\n// Ini adalah program pertama yang biasanya dibuat saat belajar Arduino\n\n// Konstanta untuk pin LED\nconst int LED_PIN = 13;  // Pin 13 sudah ada LED built-in di Arduino Uno\n\nvoid setup() {\n  // setup() dijalankan SEKALI saat Arduino menyala\n  pinMode(LED_PIN, OUTPUT);  // Set pin 13 sebagai output\n  Serial.begin(9600);        // Mulai komunikasi serial\n  Serial.println(\"Arduino Skills LABS siap!\");\n}\n\nvoid loop() {\n  // loop() dijalankan TERUS MENERUS\n  digitalWrite(LED_PIN, HIGH);  // Nyalakan LED\n  Serial.println(\"LED ON\");\n  delay(1000);                  // Tunggu 1 detik (1000ms)\n\n  digitalWrite(LED_PIN, LOW);   // Matikan LED\n  Serial.println(\"LED OFF\");\n  delay(1000);                  // Tunggu 1 detik\n}",
                        "code_language" => "cpp",
                        "checkpoint" =>
                            "1. Upload sketch Blink ke Arduino dan amati LED berkedip\n2. Ubah delay menjadi 500ms - apa yang terjadi?\n3. Buat pola kedip SOS ( ... --- ... ) menggunakan morse code\n4. Hubungkan LED eksternal ke pin 7 dan buat kedip bergantian",
                        "order" => 1,
                        "estimated_duration" => 30,
                    ],
                ],
            ],

            // --- Database ---
            [
                "lab_category_id" => $catDb->id,
                "major_id" => $tk->id,
                "title" => "SQL Fundamentals",
                "slug" => "sql-fundamentals",
                "description" =>
                    "Pelajari bahasa SQL dari dasar untuk berinteraksi dengan database relasional. Lab ini mencakup SELECT, INSERT, UPDATE, DELETE, JOIN, dan agregasi data.",
                "objective" =>
                    "1. Memahami konsep database relasional\n2. Menulis query SELECT dengan kondisi dan sorting\n3. Melakukan operasi CRUD\n4. Menggunakan JOIN untuk menggabungkan tabel\n5. Agregasi data dengan GROUP BY",
                "prerequisites" => "Tidak ada prerequisite.",
                "tools_needed" =>
                    "- MySQL (sudah include di Laragon)\n- HeidiSQL atau phpMyAdmin\n- MySQL Workbench (opsional)",
                "level" => "beginner",
                "estimated_duration" => 120,
                "is_active" => true,
                "is_featured" => false,
                "modules" => [
                    [
                        "title" => "SELECT Query & Filtering",
                        "content" =>
                            "## SQL - Structured Query Language\n\nSQL adalah bahasa standar untuk berinteraksi dengan database relasional. Hampir setiap aplikasi modern menggunakan database dan SQL.\n\n## SELECT Statement\n\nSELECT adalah perintah paling sering digunakan untuk mengambil data dari database.",
                        "video_url" =>
                            "https://www.youtube.com/watch?v=HXV3zeQKqGY",
                        "reference_url" =>
                            "https://www.sqlzoo.net/wiki/SELECT_basics",
                        "code_example" =>
                            "-- Buat database dan tabel untuk latihan\nCREATE DATABASE IF NOT EXISTS skills_demo;\nUSE skills_demo;\n\n-- Buat tabel mahasiswa\nCREATE TABLE mahasiswa (\n    id         INT AUTO_INCREMENT PRIMARY KEY,\n    nim        VARCHAR(15) UNIQUE NOT NULL,\n    nama       VARCHAR(100) NOT NULL,\n    jurusan    VARCHAR(50),\n    semester   INT,\n    ipk        DECIMAL(3,2),\n    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n);\n\n-- Insert data contoh\nINSERT INTO mahasiswa (nim, nama, jurusan, semester, ipk) VALUES\n('TK2024001', 'Andi Pratama',    'Teknik Komputer', 3, 3.75),\n('TK2024002', 'Budi Santoso',    'Teknik Komputer', 3, 3.50),\n('TK2024003', 'Citra Dewi',      'Teknik Komputer', 5, 3.90),\n('TK2024004', 'Doni Irawan',     'Teknik Informatika', 3, 3.20),\n('TK2024005', 'Eka Putri',       'Teknik Informatika', 5, 3.80);\n\n-- Query SELECT dasar\nSELECT * FROM mahasiswa;\n\n-- Select kolom tertentu\nSELECT nim, nama, ipk FROM mahasiswa;\n\n-- Filter dengan WHERE\nSELECT * FROM mahasiswa WHERE jurusan = 'Teknik Komputer';\nSELECT * FROM mahasiswa WHERE ipk >= 3.5;\nSELECT * FROM mahasiswa WHERE semester = 3 AND ipk > 3.0;\n\n-- Sorting\nSELECT * FROM mahasiswa ORDER BY ipk DESC;\nSELECT * FROM mahasiswa ORDER BY nama ASC;\n\n-- Limit\nSELECT * FROM mahasiswa ORDER BY ipk DESC LIMIT 3;",
                        "code_language" => "sql",
                        "checkpoint" =>
                            "1. Buat tabel mahasiswa dan isi dengan minimal 5 data\n2. Tampilkan hanya mahasiswa dengan IPK di atas 3.5\n3. Tampilkan 3 mahasiswa dengan IPK tertinggi\n4. Filter mahasiswa berdasarkan jurusan DAN semester tertentu",
                        "order" => 1,
                        "estimated_duration" => 30,
                    ],
                ],
            ],
        ];

        foreach ($labs as $labData) {
            $modules = $labData["modules"];
            unset($labData["modules"]);

            $lab = Lab::create($labData);

            foreach ($modules as $moduleData) {
                $lab->modules()->create($moduleData);
            }
        }
    }
}
