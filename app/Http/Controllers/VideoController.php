<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\VideoControllerHelper;
use App\Http\Requests\Videos\UserVideoFeedbackUpdateRequest;
use App\Http\Requests\Videos\VideoIndexRequest;
use App\Http\Requests\Videos\VideoStoreRequest;
use App\Http\Requests\Videos\VideoUpdateRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(VideoIndexRequest $request)
    {
        return (new VideoControllerHelper)
            ->pagingSearchData($request, new Video(), VideoResource::class);
    }

    public function store(VideoStoreRequest $request)
    {
        $video = Video::create($request->validated());
        return new VideoResource($video);
    }

    public function show(Video $video)
    {
        return new VideoResource($video);
    }

//    public function update(VideoUpdateRequest $request, Video $video)
//    {
//        $video->update($request->validated());
//        return new VideoResource($video);
//    }

    public function updateUserVideoFeedback(UserVideoFeedbackUpdateRequest $request, Video $video)
    {
        $user = Auth::user();

        $user->userFeedback()->syncWithoutDetaching([
            $video->id => [
                'rating' => $request->input('rating', 0),
                'feedback' => $request->input('feedback', null),
                'last_progress' => $request->input('last_progress', '00:00:00'),
            ]
        ]);

        $feedback = $user->userFeedback()->where('video_id', $video->id)->first()->pivot;

        return $feedback;
    }

//    public function destroy($id)
//    {
//        if (!Video::findOrFail($id)->delete())
//            abort(403);
//    }
}
