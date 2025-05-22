<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\KeluargaPendikar;
use App\Models\Diskusi;


Class StatisticController extends Controller{
    public function index() {
        $jumlahKeluarga = KeluargaPendikar::count();
        $jumlahDiskusi = Diskusi::count();
        $jumlahJadwal = 32; // Misal statis, atau bisa juga dynamic jika kamu punya modelnya

        return view('admin.dashboard', compact('jumlahKeluarga', 'jumlahDiskusi', 'jumlahJadwal'));
    }
}
