<?php

namespace App\Http\Resources;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Fetch the first video ID for the chapter
        $firstVideoId = Video::where('chapter_id', $this->id)->value('id');

        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'estimated_time' => $this->estimated_time,
            'image_url' => $this->image_url,
            'UserChapterProgress' => $this->UserChapterProgress->isNotEmpty() ? $this->UserChapterProgress->map(function ($progress) {
                return [
                    'chapter_id' => $progress->pivot->chapter_id,
                    'user_id' => $progress->pivot->user_id,
                    'last_video_id' => $progress->pivot->last_video_id,
                    'last_video_show_at' => $progress->pivot->last_video_show_at,
                    'remaining_duration' => $progress->pivot->remaining_duration,
                    'created_at' => $progress->pivot->created_at,
                    'updated_at' => $progress->pivot->updated_at,
                ];
            }) : [
                'last_video_id' => $firstVideoId
            ],
        ];
    }
}
