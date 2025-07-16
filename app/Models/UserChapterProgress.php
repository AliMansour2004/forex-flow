<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChapterProgress extends Pivot
{
    use HasFactory;

    protected $table = 'user_chapter_progress';

    protected $fillable = [
        'chapter_id',
        'user_id',
        'last_video_id',
        'last_video_show_at',
        'remaining_duration',
    ];


    public function chapter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
