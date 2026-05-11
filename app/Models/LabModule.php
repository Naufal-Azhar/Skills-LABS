<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabModule extends Model
{
    use HasFactory;

    protected $fillable = [
        "lab_id",
        "title",
        "content",
        "video_url",
        "reference_url",
        "code_example",
        "code_language",
        "checkpoint",
        "order",
        "estimated_duration",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function progresses()
    {
        return $this->hasMany(ModuleProgress::class);
    }

    public function getYoutubeEmbedIdAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }
        preg_match(
            "/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/",
            $this->video_url,
            $matches,
        );
        return $matches[1] ?? null;
    }
}
