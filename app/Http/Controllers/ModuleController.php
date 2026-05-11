<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Lab;
use App\Models\LabModule;
use App\Models\ModuleProgress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function show(string $slug, int $moduleId): View
    {
        $lab = Lab::with([
            "modules" => fn($q) => $q
                ->where("is_active", true)
                ->orderBy("order"),
        ])
            ->where("slug", $slug)
            ->firstOrFail();

        $module = LabModule::where("lab_id", $lab->id)->findOrFail($moduleId);

        $enrollment = Enrollment::where("user_id", auth()->id())
            ->where("lab_id", $lab->id)
            ->firstOrFail();

        $completedModuleIds = auth()
            ->user()
            ->moduleProgresses()
            ->where("lab_id", $lab->id)
            ->pluck("lab_module_id")
            ->toArray();

        $isCompleted = in_array($module->id, $completedModuleIds);

        $modules = $lab->modules;
        $currentIdx = $modules->search(fn($m) => $m->id === $module->id);
        $prevModule = $currentIdx > 0 ? $modules[$currentIdx - 1] : null;
        $nextModule =
            $currentIdx < $modules->count() - 1
                ? $modules[$currentIdx + 1]
                : null;

        return view(
            "labs.module",
            compact(
                "lab",
                "module",
                "enrollment",
                "completedModuleIds",
                "isCompleted",
                "modules",
                "prevModule",
                "nextModule",
            ),
        );
    }

    public function complete(Request $request, int $moduleId): RedirectResponse
    {
        $module = LabModule::findOrFail($moduleId);
        $user = auth()->user();
        $lab = $module->lab;

        ModuleProgress::firstOrCreate(
            ["user_id" => $user->id, "lab_module_id" => $module->id],
            ["lab_id" => $lab->id, "completed_at" => now()],
        );

        // Update progress percent
        $totalModules = $lab->modules()->where("is_active", true)->count();
        $completedModules = ModuleProgress::where("user_id", $user->id)
            ->where("lab_id", $lab->id)
            ->count();

        $percent =
            $totalModules > 0
                ? round(($completedModules / $totalModules) * 100)
                : 0;

        $enrollment = Enrollment::where("user_id", $user->id)
            ->where("lab_id", $lab->id)
            ->first();
        if ($enrollment) {
            $enrollment->update(["progress_percent" => $percent]);

            // Jika sudah 100%, tandai selesai dan buat sertifikat
            if ($percent >= 100 && !$enrollment->completed_at) {
                $enrollment->update(["completed_at" => now()]);

                Certificate::firstOrCreate(
                    ["user_id" => $user->id, "lab_id" => $lab->id],
                    [
                        "certificate_code" =>
                            strtoupper(Str::random(4)) .
                            "-" .
                            strtoupper(Str::random(4)) .
                            "-" .
                            $user->id,
                        "issued_at" => now(),
                    ],
                );
            }
        }

        // Redirect ke modul berikutnya atau halaman lab
        $nextModule = LabModule::where("lab_id", $lab->id)
            ->where("order", ">", $module->order)
            ->where("is_active", true)
            ->orderBy("order")
            ->first();

        if ($nextModule) {
            return redirect()
                ->route("modules.show", [$lab->slug, $nextModule->id])
                ->with("success", "Modul selesai! Lanjut ke modul berikutnya.");
        }

        return redirect()
            ->route("labs.show", $lab->slug)
            ->with(
                "success",
                $percent >= 100
                    ? "Selamat! Kamu telah menyelesaikan lab ini. Sertifikat sudah diterbitkan! 🎉"
                    : "Modul selesai!",
            );
    }
}
