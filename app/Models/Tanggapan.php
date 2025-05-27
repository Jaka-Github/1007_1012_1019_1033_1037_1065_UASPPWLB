<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = [
        'diskusi_id',
        'user_id',
        'isi',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function diskusi()
    {
        return $this->belongsTo(Diskusi::class);
    }
}
