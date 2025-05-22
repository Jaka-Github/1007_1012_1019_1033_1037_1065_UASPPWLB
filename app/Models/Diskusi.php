<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;

    protected $table = 'diskusi';

    protected $fillable = [
        'topik',
        'isi',
        'user_id',
    ];

    // Relasi: Diskusi dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
