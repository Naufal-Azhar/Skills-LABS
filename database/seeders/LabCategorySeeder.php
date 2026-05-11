<?php

namespace Database\Seeders;

use App\Models\LabCategory;
use Illuminate\Database\Seeder;

class LabCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                "name" => "Programming Fundamentals",
                "slug" => "programming-fundamentals",
                "description" =>
                    "Dasar-dasar pemrograman: algoritma, logika, dan struktur data.",
                "icon" => "💻",
                "color" => "blue",
                "order" => 1,
            ],
            [
                "name" => "Web Development",
                "slug" => "web-development",
                "description" =>
                    "Pengembangan aplikasi web dari front-end hingga back-end.",
                "icon" => "🌐",
                "color" => "indigo",
                "order" => 2,
            ],
            [
                "name" => "Networking & Systems",
                "slug" => "networking-systems",
                "description" =>
                    "Jaringan komputer, Linux, dan administrasi sistem.",
                "icon" => "🔧",
                "color" => "gray",
                "order" => 3,
            ],
            [
                "name" => "IoT & Embedded Systems",
                "slug" => "iot-embedded",
                "description" =>
                    "Arduino, Raspberry Pi, sensor, dan proyek IoT.",
                "icon" => "🤖",
                "color" => "green",
                "order" => 4,
            ],
            [
                "name" => "AI & Data Science",
                "slug" => "ai-data-science",
                "description" =>
                    "Machine learning, data analysis, dan kecerdasan buatan.",
                "icon" => "🧠",
                "color" => "purple",
                "order" => 5,
            ],
            [
                "name" => "Database",
                "slug" => "database",
                "description" => "SQL, desain database, dan manajemen data.",
                "icon" => "🗄️",
                "color" => "orange",
                "order" => 6,
            ],
        ];

        foreach ($categories as $cat) {
            LabCategory::create($cat);
        }
    }
}
