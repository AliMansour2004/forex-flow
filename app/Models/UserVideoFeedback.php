<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVideoFeedback extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'user_id',
        'rating',
        'feedback',
        'last_progress',
    ];

    protected $table = 'user_video_feedback';

    public function videos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
