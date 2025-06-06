<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbadahPlan extends Model
{
    use HasFactory;

    protected $table = 'ibadah_plans';

    
    protected $fillable = [
        'user_id',
        'title',
        'category',
        'target',
        'start_date',
        'end_date',
        'duration', // ✅ Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(IbadahLog::class);
    }
}
