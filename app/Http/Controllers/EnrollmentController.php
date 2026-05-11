<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Lab;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request, string $slug): RedirectResponse
    {
        $lab = Lab::where("slug", $slug)
            ->where("is_active", true)
            ->firstOrFail();
        $user = auth()->user();

        $exists = Enrollment::where("user_id", $user->id)
            ->where("lab_id", $lab->id)
            ->exists();

        if (!$exists) {
            Enrollment::create([
                "user_id" => $user->id,
                "lab_id" => $lab->id,
                "enrolled_at" => now(),
                "progress_percent" => 0,
            ]);
        }

        return redirect()
            ->route("labs.learn", $slug)
            ->with("success", "Berhasil enroll lab!");
    }
}
