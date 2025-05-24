<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('diskusi', function (Blueprint $table) {
            $table->foreignId('agama_id')->nullable()->constrained('agama')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('diskusi', function (Blueprint $table) {
            $table->dropForeign(['agama_id']);
            $table->dropColumn('agama_id');
        });
    }

};
