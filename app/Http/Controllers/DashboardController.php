<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $enrollments = Enrollment::with(["lab.category", "lab.modules"])
            ->where("user_id", $user->id)
            ->latest()
            ->get();

        $recommendedLabs = Lab::with(["category", "major"])
            ->where("is_active", true)
            ->where("major_id", $user->major_id)
            ->whereNotIn("id", $enrollments->pluck("lab_id"))
            ->limit(4)
            ->get();

        if ($recommendedLabs->count() < 4) {
            $extra = Lab::with(["category"])
                ->where("is_active", true)
                ->whereNotIn("id", $enrollments->pluck("lab_id"))
                ->whereNotIn("id", $recommendedLabs->pluck("id"))
                ->limit(4 - $recommendedLabs->count())
                ->get();
            $recommendedLabs = $recommendedLabs->merge($extra);
        }

        $certificates = $user->certificates()->with("lab")->latest()->get();
        $totalModules = $enrollments->sum(fn($e) => $e->lab->modules->count());
        $completedCount = $enrollments
            ->where("completed_at", "!=", null)
            ->count();

        return view(
            "dashboard.index",
            compact(
                "user",
                "enrollments",
                "recommendedLabs",
                "certificates",
                "totalModules",
                "completedCount",
            ),
        );
    }

    public function progress(): View
    {
        $user = auth()->user();
        $enrollments = Enrollment::with(["lab.category", "lab.modules"])
            ->where("user_id", $user->id)
            ->latest()
            ->get();

        return view("dashboard.progress", compact("user", "enrollments"));
    }
}
