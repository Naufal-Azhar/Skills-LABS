<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Lab;
use App\Models\LabCategory;
use App\Models\User;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LabController extends Controller
{
    public function landing(): View
    {
        $featuredLabs = Lab::with(["category", "major"])
            ->where("is_active", true)
            ->where("is_featured", true)
            ->limit(6)
            ->get();

        $categories = LabCategory::withCount("labs")->orderBy("order")->get();

        $stats = [
            "labs" => Lab::where("is_active", true)->count(),
            "students" => User::where("role", "student")->count(),
            "modules" => \App\Models\LabModule::count(),
            "certs" => Certificate::count(),
        ];

        return view("welcome", compact("featuredLabs", "categories", "stats"));
    }

    public function index(Request $request): View
    {
        $query = Lab::with(["category", "major"])->where("is_active", true);

        if ($request->filled("category")) {
            $query->whereHas(
                "category",
                fn($q) => $q->where("slug", $request->category),
            );
        }
        if ($request->filled("level")) {
            $query->where("level", $request->level);
        }
        if ($request->filled("search")) {
            $query->where("title", "like", "%" . $request->search . "%");
        }

        $labs = $query->latest()->paginate(9);
        $categories = LabCategory::orderBy("order")->get();

        return view("labs.index", compact("labs", "categories"));
    }

    public function show(string $slug): View
    {
        $lab = Lab::with([
            "category",
            "major",
            "modules" => fn($q) => $q->where("is_active", true),
        ])
            ->where("slug", $slug)
            ->where("is_active", true)
            ->firstOrFail();

        $lab->increment("views");

        $enrollment = null;
        if (auth()->check()) {
            $enrollment = Enrollment::where("user_id", auth()->id())
                ->where("lab_id", $lab->id)
                ->first();
        }

        $relatedLabs = Lab::with("category")
            ->where("lab_category_id", $lab->lab_category_id)
            ->where("id", "!=", $lab->id)
            ->where("is_active", true)
            ->limit(3)
            ->get();

        return view("labs.show", compact("lab", "enrollment", "relatedLabs"));
    }

    public function learn(string $slug): View|RedirectResponse
    {
        $lab = Lab::with([
            "modules" => fn($q) => $q
                ->where("is_active", true)
                ->orderBy("order"),
        ])
            ->where("slug", $slug)
            ->firstOrFail();

        $enrollment = Enrollment::where("user_id", auth()->id())
            ->where("lab_id", $lab->id)
            ->firstOrFail();

        $completedModuleIds = auth()
            ->user()
            ->moduleProgresses()
            ->where("lab_id", $lab->id)
            ->pluck("lab_module_id")
            ->toArray();

        $firstIncomplete = $lab->modules->firstWhere(
            fn($m) => !in_array($m->id, $completedModuleIds),
        );
        $firstModule = $firstIncomplete ?? $lab->modules->first();

        if ($firstModule) {
            return redirect()->route("modules.show", [$slug, $firstModule->id]);
        }

        return view(
            "labs.learn",
            compact("lab", "enrollment", "completedModuleIds"),
        );
    }
}
