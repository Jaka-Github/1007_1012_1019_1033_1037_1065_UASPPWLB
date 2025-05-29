<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ibadah_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ibadah_plan_id')->constrained('ibadah_plans')->onDelete('cascade');
            $table->date('date');
            $table->boolean('status')->default(false); // true: done, false: missed
            $table->text('notes')->nullable(); // optional: refleksi, kondisi, kendala
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibadah_logs');
    }
};
