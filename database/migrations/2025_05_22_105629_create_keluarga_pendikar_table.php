<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keluarga_pendikar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_keluarga');
            $table->timestamps();
        });

        Schema::table('anggota_pendikar', function (Blueprint $table) {
            $table->foreignId('keluarga_id')
                  ->nullable()
                  ->constrained('keluarga_pendikar')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('anggota_pendikar', function (Blueprint $table) {
            $table->dropForeign(['keluarga_id']);
            $table->dropColumn('keluarga_id');
        });

        Schema::dropIfExists('keluarga_pendikar');
    }
};
