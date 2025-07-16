<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $chapters = Chapter::all();
        $instructor = User::role('instructor')->first();

        foreach ($chapters as $chapter) {
            for ($i = 1; $i <= 5; $i++) {
                Video::create([
                    'chapter_id' => $chapter->id,
                    'instructor_id' => $instructor->id,
                    'title' => "Video $i of Chapter {$chapter->title}",
                    'description' => "Description for video $i of chapter {$chapter->title}",
                    'url' => 'https://via.placeholder.com/150',
                    'image_url' => 'https://via.placeholder.com/150',
                    'skill_level' => $i % 2 == 0 ? 'beginner' : 'advanced', // Alternating skill level
                    'video_duration' => '00:10:00', // 10 minutes
                    'language' => 'EN',
                ]);
            }
        }
    }
}
