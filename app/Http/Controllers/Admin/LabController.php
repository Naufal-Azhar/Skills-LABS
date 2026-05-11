<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabCategory;
use App\Models\LabModule;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LabController extends Controller
{
    public function index(): View
    {
        $labs = Lab::with(["category", "major"])
            ->withCount("enrollments")
            ->latest()
            ->paginate(10);
        return view("admin.labs.index", compact("labs"));
    }

    public function create(): View
    {
        $categories = LabCategory::orderBy("order")->get();
        $majors = Major::with("faculty")->get();
        return view("admin.labs.create", compact("categories", "majors"));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            "title" => "required|string|max:255",
            "lab_category_id" => "required|exists:lab_categories,id",
            "major_id" => "nullable|exists:majors,id",
            "description" => "required|string",
            "objective" => "nullable|string",
            "prerequisites" => "nullable|string",
            "tools_needed" => "nullable|string",
            "level" => "required|in:beginner,intermediate,advanced",
            "estimated_duration" => "required|integer|min:1",
            "is_active" => "boolean",
            "is_featured" => "boolean",
        ]);

        $data["slug"] = Str::slug($request->title);
        $data["created_by"] = auth()->id();
        $data["is_active"] = $request->boolean("is_active");
        $data["is_featured"] = $request->boolean("is_featured");

        Lab::create($data);

        return redirect()
            ->route("admin.labs.index")
            ->with("success", "Lab berhasil ditambahkan!");
    }

    public function edit(Lab $lab): View
    {
        $categories = LabCategory::orderBy("order")->get();
        $majors = Major::with("faculty")->get();
        $lab->load("modules");
        return view("admin.labs.edit", compact("lab", "categories", "majors"));
    }

    public function update(Request $request, Lab $lab): RedirectResponse
    {
        $data = $request->validate([
            "title" => "required|string|max:255",
            "lab_category_id" => "required|exists:lab_categories,id",
            "major_id" => "nullable|exists:majors,id",
            "description" => "required|string",
            "objective" => "nullable|string",
            "prerequisites" => "nullable|string",
            "tools_needed" => "nullable|string",
            "level" => "required|in:beginner,intermediate,advanced",
            "estimated_duration" => "required|integer|min:1",
        ]);

        $data["is_active"] = $request->boolean("is_active");
        $data["is_featured"] = $request->boolean("is_featured");

        $lab->update($data);

        return redirect()
            ->route("admin.labs.index")
            ->with("success", "Lab berhasil diupdate!");
    }

    public function destroy(Lab $lab): RedirectResponse
    {
        $lab->delete();
        return redirect()
            ->route("admin.labs.index")
            ->with("success", "Lab berhasil dihapus!");
    }

    public function show(Lab $lab): View
    {
        $lab->load("modules", "category", "major");
        return view("admin.labs.show", compact("lab"));
    }
}
