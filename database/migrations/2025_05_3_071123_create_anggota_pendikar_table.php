<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota_pendikar', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('umur'); // tambah umur
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // tambah jenis kelamin
            $table->string('alamat'); // tambah alamat
            $table->foreignId('agama_id')->constrained('agama')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('keluarga_id')->constrained('keluarga_pendikar')->onDelete('cascade'); 
            $table->timestamps();
        });
    }
    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_pendikar');
    }
};
