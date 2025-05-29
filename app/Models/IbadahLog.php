<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbadahLog extends Model
{
    use HasFactory;

    protected $table = 'ibadah_logs';

    protected $fillable = [
        'user_id',
        'ibadah_plan_id',
        'date',
        'is_done',
        'note',
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(IbadahPlan::class, 'ibadah_plan_id');
    }

    public function feedback()
    {
        return $this->hasOne(MentorFeedback::class);
    }
}
