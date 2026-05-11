<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "nim",
        "email",
        "password",
        "phone",
        "major_id",
        "avatar",
        "role",
        "is_active",
        "bio",
        "semester",
    ];

    protected $hidden = ["password", "remember_token"];

    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "is_active" => "boolean",
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function moduleProgresses()
    {
        return $this->hasMany(ModuleProgress::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === "admin";
    }

    public function isStudent(): bool
    {
        return $this->role === "student";
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset("storage/" . $this->avatar);
        }
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=1E40AF&color=fff&size=128";
    }
}
