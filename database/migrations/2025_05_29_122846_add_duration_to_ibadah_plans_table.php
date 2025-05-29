<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ibadah_plans', function (Blueprint $table) {
            $table->integer('duration')->after('target')->nullable();
        });
    }

    public function down()
    {
        Schema::table('ibadah_plans', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
