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
        Schema::create("labs", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("lab_category_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("major_id")
                ->nullable()
                ->constrained()
                ->onDelete("set null");
            $table
                ->foreignId("created_by")
                ->nullable()
                ->constrained("users")
                ->onDelete("set null");
            $table->string("title");
            $table->string("slug")->unique();
            $table->text("description");
            $table->text("objective")->nullable();
            $table->text("prerequisites")->nullable();
            $table->text("tools_needed")->nullable();
            $table->string("thumbnail")->nullable();
            $table
                ->enum("level", ["beginner", "intermediate", "advanced"])
                ->default("beginner");
            $table
                ->integer("estimated_duration")
                ->default(60)
                ->comment("in minutes");
            $table->boolean("is_active")->default(true);
            $table->boolean("is_featured")->default(false);
            $table->integer("views")->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("labs");
    }
};
