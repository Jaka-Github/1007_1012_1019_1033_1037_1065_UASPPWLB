<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgamaIdToDiskusiTable extends Migration
{
    public function up()
    {
        Schema::table('diskusi', function (Blueprint $table) {
            // Cek apakah kolom 'agama_id' belum ada
            if (!Schema::hasColumn('diskusi', 'agama_id')) {
                $table->foreignId('agama_id')
                      ->after('user_id')
                      ->constrained('agama')
                      ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('diskusi', function (Blueprint $table) {
            // Cek apakah kolom 'agama_id' ada sebelum di-drop
            if (Schema::hasColumn('diskusi', 'agama_id')) {
                $table->dropForeign(['agama_id']);
                $table->dropColumn('agama_id');
            }
        });
    }
}
