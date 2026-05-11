<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "lab_module_id",
        "lab_id",
        "completed_at",
        "notes",
    ];

    protected $casts = [
        "completed_at" => "datetime",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(LabModule::class, "lab_module_id");
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }
}
