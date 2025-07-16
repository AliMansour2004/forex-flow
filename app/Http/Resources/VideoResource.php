<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $instructors = $this->instructors;
        return [
            'id' => $this->id,
            'chapter_id' => $this->chapter_id,
//            'user_feedback' => $this->userFeedback,
            'instructor_id' => $this->instructor_id,
            'instructor_name' => $instructors->first_name . ' ' . $instructors->last_name,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'image_url' => $this->image_url,
            'skill_level' => $this->skill_level,
            'video_duration' => $this->video_duration,
            'language' => $this->language,
        ];
    }
}
