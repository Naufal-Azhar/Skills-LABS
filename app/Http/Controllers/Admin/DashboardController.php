<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Lab;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            "students" => User::where("role", "student")->count(),
            "labs" => Lab::count(),
            "enrollments" => Enrollment::count(),
            "certificates" => Certificate::count(),
        ];

        $recentStudents = User::where("role", "student")
            ->with("major.faculty")
            ->latest()
            ->limit(5)
            ->get();

        $popularLabs = Lab::withCount("enrollments")
            ->orderByDesc("enrollments_count")
            ->limit(5)
            ->get();

        return view(
            "admin.dashboard",
            compact("stats", "recentStudents", "popularLabs"),
        );
    }
}
