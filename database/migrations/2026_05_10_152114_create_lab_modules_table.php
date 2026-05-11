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
        Schema::create("lab_modules", function (Blueprint $table) {
            $table->id();
            $table->foreignId("lab_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table
                ->longText("content")
                ->nullable()
                ->comment("Markdown content");
            $table
                ->string("video_url")
                ->nullable()
                ->comment("YouTube embed URL");
            $table
                ->string("reference_url")
                ->nullable()
                ->comment("Link ke sumber eksternal");
            $table
                ->longText("code_example")
                ->nullable()
                ->comment("Code praktik");
            $table->string("code_language", 30)->nullable();
            $table
                ->text("checkpoint")
                ->nullable()
                ->comment("Pertanyaan/task checkpoint");
            $table->integer("order")->default(0);
            $table
                ->integer("estimated_duration")
                ->default(15)
                ->comment("in minutes");
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("lab_modules");
    }
};
