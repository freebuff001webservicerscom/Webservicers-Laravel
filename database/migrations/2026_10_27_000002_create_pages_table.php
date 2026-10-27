<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('type', 32)->default('service'); // service | company | legal
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('theme', 32)->nullable();
            $table->string('status', 32)->default('published'); // published | draft
            $table->json('content');
            $table->timestamps();

            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
