<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        "lab_category_id",
        "major_id",
        "created_by",
        "title",
        "slug",
        "description",
        "objective",
        "prerequisites",
        "tools_needed",
        "thumbnail",
        "level",
        "estimated_duration",
        "is_active",
        "is_featured",
        "views",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "is_featured" => "boolean",
    ];

    public function category()
    {
        return $this->belongsTo(LabCategory::class, "lab_category_id");
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function modules()
    {
        return $this->hasMany(LabModule::class)->orderBy("order");
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getLevelBadgeAttribute(): string
    {
        return match ($this->level) {
            "beginner" => "bg-green-100 text-green-800",
            "intermediate" => "bg-yellow-100 text-yellow-800",
            "advanced" => "bg-red-100 text-red-800",
            default => "bg-gray-100 text-gray-800",
        };
    }

    public function getLevelLabelAttribute(): string
    {
        return match ($this->level) {
            "beginner" => "Pemula",
            "intermediate" => "Menengah",
            "advanced" => "Lanjutan",
            default => $this->level,
        };
    }
}
