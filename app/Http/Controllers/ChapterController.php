<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\ChapterControllerHelper;
use App\Http\Requests\Chapters\ChapterIndexRequest;
use App\Http\Requests\Chapters\ChapterStoreRequest;
use App\Http\Requests\Chapters\ChapterUpdateRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Illuminate\Routing\Controller;

class ChapterController extends Controller
{
    public function index(ChapterIndexRequest $request)
    {
        return (new ChapterControllerHelper)
            ->pagingSearchData($request, new Chapter(), ChapterResource::class);
    }

    public function store(ChapterStoreRequest $request)
    {
        $chapter = Chapter::create($request->validated());
        return new ChapterResource($chapter);
    }

    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    public function update(ChapterUpdateRequest $request, Chapter $chapter)
    {
        $chapter->update($request->validated());
        return new ChapterResource($chapter);
    }

    public function destroy($id)
    {
        if (!Chapter::findOrFail($id)->delete())
            abort(403);
    }
}
