<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ibadah_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('category', [
                'tilawah', 'puasa', 'dzikir', 'qiyamul_lail',
                'infaq', 'reflection', 'dhuha'
            ]);
            $table->string('target'); // e.g. "1 juz/week", "Senin-Kamis selama Ramadan"
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibadah_plans');
    }
};

