<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    public function run()
    {
        DB::table('agama')->insert([
            ['nama_agama' => 'Islam'],
            ['nama_agama' => 'Kristen'],
            ['nama_agama' => 'Hindu'],
            ['nama_agama' => 'Budha'],
            ['nama_agama' => 'Konghucu'],
            ['nama_agama' => 'Katolik'],
            ['nama_agama' => 'Kepercayaan'],
        ]);
    }
}


