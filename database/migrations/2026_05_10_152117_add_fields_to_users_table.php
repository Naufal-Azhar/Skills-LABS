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
        Schema::table("users", function (Blueprint $table) {
            $table->string("nim", 20)->unique()->nullable()->after("name");
            $table->string("phone", 20)->nullable()->after("email");
            $table
                ->foreignId("major_id")
                ->nullable()
                ->after("phone")
                ->constrained()
                ->onDelete("set null");
            $table->string("avatar")->nullable()->after("major_id");
            $table
                ->enum("role", ["student", "admin"])
                ->default("student")
                ->after("avatar");
            $table->boolean("is_active")->default(true)->after("role");
            $table->text("bio")->nullable()->after("is_active");
            $table->integer("semester")->nullable()->after("bio");
        });
    }

    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dropForeign(["major_id"]);
            $table->dropColumn([
                "nim",
                "phone",
                "major_id",
                "avatar",
                "role",
                "is_active",
                "bio",
                "semester",
            ]);
        });
    }
};
