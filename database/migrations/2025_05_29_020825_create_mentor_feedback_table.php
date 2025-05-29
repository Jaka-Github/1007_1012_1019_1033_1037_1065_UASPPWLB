<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mentor_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibadah_log_id')->constrained('ibadah_logs')->onDelete('cascade');
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade'); // diasumsikan mentor adalah user
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_feedback');
    }
};
