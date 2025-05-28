<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KeluargaPendikar;
use App\Models\AnggotaPendikar;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total keluarga
        $jumlahKeluarga = KeluargaPendikar::count();
        
        // Hitung total anggota pendikar
        $jumlahAnggota = AnggotaPendikar::count();
        
        // Hitung total jadwal ibadah (asumsi ada tabel jadwal_ibadah)
        $jumlahJadwal = DB::table('jadwal_ibadah')->count();
        
        // Hitung total tanggapan dari user yang sedang login
        $jumlahTanggapan = Tanggapan::where('user_id', Auth::id())->count();
        
        // Data tambahan untuk statistik
        $statistikAgama = AnggotaPendikar::select('agama_id', DB::raw('count(*) as total'))
            ->with('agama')
            ->groupBy('agama_id')
            ->get();
            
        $statistikJenisKelamin = AnggotaPendikar::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();

        return view('users.dashboard', compact(
            'jumlahKeluarga',
            'jumlahAnggota', 
            'jumlahJadwal',
            'jumlahTanggapan',
            'statistikAgama',
            'statistikJenisKelamin'
        ));
    }
}
