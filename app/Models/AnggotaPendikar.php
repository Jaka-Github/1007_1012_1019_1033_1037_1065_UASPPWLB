<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPendikar extends Model
{
    use HasFactory;

    protected $table = 'anggota_pendikar';

    protected $fillable = [
        'nama',
        'agama_id',
        'umur',
        'alamat',
        'jenis_kelamin',
        'user_id',
        'keluarga_id',
    ];

    // Relasi ke agama
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke keluarga pendikar
    public function keluarga()
    {
        return $this->belongsTo(KeluargaPendikar::class, 'keluarga_id', 'id');
    }
}
