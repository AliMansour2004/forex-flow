<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course = Course::first();
        for ($i = 1; $i <= 6; $i++) {
            Chapter::create([
                'course_id' => $course->id,
                'title' => "Chapter $i",
                'sub_title' => "Sub Title $i",
                'description' => "Description for chapter $i",
                'estimated_time' => '00:30:00', // 30 minutes
                'image_url' => 'https://via.placeholder.com/150',
            ]);
        }
    }
}
