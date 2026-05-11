<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "lab_id",
        "enrolled_at",
        "completed_at",
        "progress_percent",
    ];

    protected $casts = [
        "enrolled_at" => "datetime",
        "completed_at" => "datetime",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }
}
