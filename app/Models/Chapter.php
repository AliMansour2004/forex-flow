<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'sub_title',
        'description',
        'estimated_time',
        'image_url',
    ];

    public function courses(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function videos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function UserChapterProgress()
    {
        return $this->belongsToMany(User::class, 'user_chapter_progress')
            ->using(UserChapterProgress::class)
            ->withPivot('last_video_id', 'last_video_show_at', 'remaining_duration')
            ->withTimestamps();
    }

}
