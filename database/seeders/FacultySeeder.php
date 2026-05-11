<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculties = [
            [
                "name" => "Fakultas Teknik",
                "code" => "FT",
                "description" =>
                    "Fakultas yang menyelenggarakan program studi bidang teknik dan teknologi.",
            ],
            [
                "name" => "Fakultas Ekonomi dan Bisnis",
                "code" => "FEB",
                "description" =>
                    "Fakultas yang menyelenggarakan program studi bidang ekonomi dan bisnis.",
            ],
            [
                "name" => "Fakultas Ilmu Komputer",
                "code" => "FIK",
                "description" =>
                    "Fakultas yang menyelenggarakan program studi bidang ilmu komputer dan informatika.",
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
