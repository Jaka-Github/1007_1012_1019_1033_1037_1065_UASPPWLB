<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Agama; // Pastikan model Agama sudah ada

class AgamaSeeder extends Seeder
{
    public function run()
    {
        $agamas = [
            'Islam',
            'Kristen',
            'Hindu',
            'Budha',
            'Konghucu',
            'Katolik',
            'Kepercayaan',
        ];

        foreach ($agamas as $nama) {
            Agama::firstOrCreate(['nama_agama' => $nama]);
        }
    }
}


