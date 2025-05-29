<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorFeedback extends Model
{
    use HasFactory;

    protected $table = 'mentor_feedback';

    protected $fillable = [
        'ibadah_log_id',
        'comment',
        'status', // 'verified' or 'not_verified'
    ];

    public function log()
    {
        return $this->belongsTo(IbadahLog::class, 'ibadah_log_id');
    }
}
