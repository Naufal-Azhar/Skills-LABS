<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            "name" => "Admin Skills LABS",
            "nim" => "ADMIN001",
            "email" => "admin@skillslabs.iteba.ac.id",
            "password" => Hash::make("admin123"),
            "role" => "admin",
            "is_active" => true,
        ]);

        // Demo student
        $tk = Major::where("code", "TK")->first();

        User::create([
            "name" => "Demo Mahasiswa",
            "nim" => "TK2024001",
            "email" => "mahasiswa@example.com",
            "password" => Hash::make("password"),
            "major_id" => $tk?->id,
            "role" => "student",
            "semester" => 3,
            "is_active" => true,
            "bio" =>
                "Mahasiswa Teknik Komputer ITEBA yang sedang belajar di Skills LABS.",
        ]);
    }
}
