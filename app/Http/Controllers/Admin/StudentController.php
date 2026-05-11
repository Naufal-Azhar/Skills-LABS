<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::with("major.faculty")->where("role", "student");

        if ($request->filled("search")) {
            $query->where(function ($q) use ($request) {
                $q->where("name", "like", "%" . $request->search . "%")
                    ->orWhere("nim", "like", "%" . $request->search . "%")
                    ->orWhere("email", "like", "%" . $request->search . "%");
            });
        }

        $students = $query->latest()->paginate(15);

        return view("admin.students.index", compact("students"));
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->update(["is_active" => !$user->is_active]);
        $status = $user->is_active ? "diaktifkan" : "dinonaktifkan";
        return back()->with(
            "success",
            "Mahasiswa {$user->name} berhasil {$status}.",
        );
    }
}
