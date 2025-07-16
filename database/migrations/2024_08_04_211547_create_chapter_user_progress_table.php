<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_chapter_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->integer('last_video_id');
            $table->date('last_video_show_at');
            $table->time('remaining_duration');

            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->unique(['chapter_id', 'user_id']);
        });


        DB::unprepared('
            CREATE TRIGGER update_user_chapter_progress
            AFTER INSERT ON user_video_feedback
            FOR EACH ROW
            BEGIN
                DECLARE last_video_id INT;
                DECLARE last_video_show_at DATE;
                DECLARE remaining_duration TIME;

                SET last_video_id = NEW.video_id;
                SET last_video_show_at = CURDATE();
                SET remaining_duration = NEW.last_progress;

                INSERT INTO user_chapter_progress (chapter_id, user_id, last_video_id, last_video_show_at, remaining_duration, created_at, updated_at)
                VALUES ((SELECT chapter_id FROM videos WHERE id = NEW.video_id), NEW.user_id, last_video_id, last_video_show_at, remaining_duration, NOW(), NOW())
                ON DUPLICATE KEY UPDATE
                    last_video_id = VALUES(last_video_id),
                    last_video_show_at = VALUES(last_video_show_at),
                    remaining_duration = VALUES(remaining_duration),
                    updated_at = VALUES(updated_at);
            END;
        ');


        DB::unprepared('
            CREATE TRIGGER update_user_chapter_progress_on_update
            AFTER UPDATE ON user_video_feedback
            FOR EACH ROW
            BEGIN
                DECLARE last_video_id INT;
                DECLARE last_video_show_at DATE;
                DECLARE remaining_duration TIME;

                SET last_video_id = NEW.video_id;
                SET last_video_show_at = CURDATE();
                SET remaining_duration = NEW.last_progress;

                INSERT INTO user_chapter_progress (chapter_id, user_id, last_video_id, last_video_show_at, remaining_duration, created_at, updated_at)
                VALUES ((SELECT chapter_id FROM videos WHERE id = NEW.video_id), NEW.user_id, last_video_id, last_video_show_at, remaining_duration, NOW(), NOW())
                ON DUPLICATE KEY UPDATE
                    last_video_id = VALUES(last_video_id),
                    last_video_show_at = VALUES(last_video_show_at),
                    remaining_duration = VALUES(remaining_duration),
                    updated_at = VALUES(updated_at);
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        DB::unprepared('DROP TRIGGER IF EXISTS update_user_chapter_progress');
        DB::unprepared('DROP TRIGGER IF EXISTS update_user_chapter_progress_on_update');


        Schema::dropIfExists('user_chapter_progress');
    }
};
