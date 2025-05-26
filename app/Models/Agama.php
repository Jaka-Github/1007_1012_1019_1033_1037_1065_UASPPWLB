<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'agama';
    protected $fillable = ['nama_agama'];

    public function diskusi()
    {
        return $this->hasMany(Diskusi::class);
    }
}
