<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('records', function (Blueprint $table): void {
            $table->id();
            $table->string('resource', 64);
            $table->json('data');
            $table->timestamps();

            $table->index(['resource', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
