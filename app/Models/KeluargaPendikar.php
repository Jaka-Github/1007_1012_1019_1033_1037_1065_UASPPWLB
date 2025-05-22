<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaPendikar extends Model
{
    use HasFactory;

    protected $table = 'keluarga_pendikar';

    protected $fillable = [
        'nama_keluarga',
    ];

    // Relasi ke anggota pendikar
    public function anggota()
    {
        return $this->hasMany(AnggotaPendikar::class, 'keluarga_id' , 'id');
    }
}
