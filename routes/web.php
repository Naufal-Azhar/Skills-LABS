<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LabController as AdminLabController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ───────────────────────────────────────────────
Route::get("/", function () {
    if (auth()->check()) {
        return redirect()->route("dashboard");
    }
    return app(\App\Http\Controllers\LabController::class)->landing(request());
})->name("home");
Route::get("/labs", [LabController::class, "index"])->name("labs.index");
Route::get("/labs/{slug}", [LabController::class, "show"])->name("labs.show");
Route::get("/verify-certificate/{code}", [
    CertificateController::class,
    "verify",
])->name("certificates.verify");

// ─── AUTH ROUTES (dari Breeze) ────────────────────────────────────
require __DIR__ . "/auth.php";

// ─── STUDENT ROUTES (login required) ─────────────────────────────
Route::middleware(["auth"])->group(function () {
    // Dashboard
    Route::get("/dashboard", [DashboardController::class, "index"])->name(
        "dashboard",
    );

    // Labs (enrolled)
    Route::get("/labs/{slug}/learn", [LabController::class, "learn"])->name(
        "labs.learn",
    );
    Route::post("/labs/{slug}/enroll", [
        EnrollmentController::class,
        "store",
    ])->name("enrollments.store");

    // Modules
    Route::get("/labs/{slug}/modules/{moduleId}", [
        ModuleController::class,
        "show",
    ])->name("modules.show");
    Route::post("/modules/{moduleId}/complete", [
        ModuleController::class,
        "complete",
    ])->name("modules.complete");

    // Progress
    Route::get("/my-progress", [DashboardController::class, "progress"])->name(
        "my.progress",
    );

    // Certificates
    Route::get("/my-certificates", [
        CertificateController::class,
        "index",
    ])->name("certificates.index");
    Route::get("/certificates/{code}/download", [
        CertificateController::class,
        "download",
    ])->name("certificates.download");

    // Profile
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
});

// ─── ADMIN ROUTES ─────────────────────────────────────────────────
Route::middleware(["auth", "admin"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::get("/", [AdminDashboardController::class, "index"])->name(
            "dashboard",
        );
        Route::resource("labs", AdminLabController::class);
        Route::get("students", [AdminStudentController::class, "index"])->name(
            "students.index",
        );
        Route::patch("students/{user}/toggle", [
            AdminStudentController::class,
            "toggle",
        ])->name("students.toggle");
    });
