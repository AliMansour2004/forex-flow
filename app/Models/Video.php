<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{

    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'instructor_id',
        'title',
        'description',
        'url',
        'image_url',
        'skill_level',
        'video_duration',
        'language',
    ];

    public function chapters(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chapter::class);//belong to one chapter
    }

    public function instructors(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function userFeedback(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_video_feedback')
            ->withPivot(['rating', 'feedback', 'last_progress'])
            ->withTimestamps()
            ->using(UserVideoFeedback::class);
    }
}
