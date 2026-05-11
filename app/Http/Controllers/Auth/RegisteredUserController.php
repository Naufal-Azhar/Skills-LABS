<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $faculties = Faculty::with("majors")->get();
        $majors = Major::with("faculty")->get();
        return view("auth.register", compact("faculties", "majors"));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                "name" => ["required", "string", "max:255"],
                "nim" => ["required", "string", "max:20", "unique:users,nim"],
                "email" => [
                    "required",
                    "string",
                    "email",
                    "max:255",
                    "unique:users",
                ],
                "major_id" => ["required", "exists:majors,id"],
                "semester" => ["required", "integer", "min:1", "max:14"],
                "password" => [
                    "required",
                    "confirmed",
                    Rules\Password::defaults(),
                ],
            ],
            [
                "name.required" => "Nama lengkap wajib diisi.",
                "nim.required" => "NIM wajib diisi.",
                "nim.unique" => "NIM sudah terdaftar.",
                "email.required" => "Email wajib diisi.",
                "email.unique" => "Email sudah terdaftar.",
                "major_id.required" => "Jurusan wajib dipilih.",
                "semester.required" => "Semester wajib diisi.",
                "password.required" => "Password wajib diisi.",
            ],
        );

        $user = User::create([
            "name" => $request->name,
            "nim" => $request->nim,
            "email" => $request->email,
            "major_id" => $request->major_id,
            "semester" => $request->semester,
            "password" => Hash::make($request->password),
            "role" => "student",
            "is_active" => true,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route("dashboard"));
    }
}
