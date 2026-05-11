<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $ft = Faculty::where("code", "FT")->first();
        $fik = Faculty::where("code", "FIK")->first();

        $majors = [
            [
                "faculty_id" => $ft->id,
                "name" => "Teknik Komputer",
                "code" => "TK",
                "description" =>
                    "Program studi yang mempelajari perangkat keras dan lunak komputer.",
            ],
            [
                "faculty_id" => $ft->id,
                "name" => "Teknik Elektro",
                "code" => "TE",
                "description" =>
                    "Program studi yang mempelajari sistem kelistrikan dan elektronika.",
            ],
            [
                "faculty_id" => $ft->id,
                "name" => "Teknik Informatika",
                "code" => "TIF",
                "description" =>
                    "Program studi yang mempelajari pengembangan perangkat lunak dan sistem informasi.",
            ],
            [
                "faculty_id" => $fik->id,
                "name" => "Sistem Informasi",
                "code" => "SI",
                "description" =>
                    "Program studi yang mengintegrasikan ilmu komputer dengan manajemen bisnis.",
            ],
            [
                "faculty_id" => $fik->id,
                "name" => "Ilmu Komputer",
                "code" => "IK",
                "description" =>
                    "Program studi yang mempelajari teori dan praktik ilmu komputer.",
            ],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}
