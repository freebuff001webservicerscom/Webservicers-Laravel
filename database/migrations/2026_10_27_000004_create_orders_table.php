<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->string('reference', 32)->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('service')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('status', 32)->default('pending'); // pending | paid | in_progress | completed | cancelled | refunded
            $table->date('placed_on');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
