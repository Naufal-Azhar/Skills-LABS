<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("certificates", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("lab_id")->constrained()->onDelete("cascade");
            $table->string("certificate_code", 20)->unique();
            $table->timestamp("issued_at")->useCurrent();
            $table->string("file_path")->nullable();
            $table->unique(["user_id", "lab_id"]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("certificates");
    }
};
