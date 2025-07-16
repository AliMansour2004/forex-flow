<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\CourseControllerHelper;
use App\Http\Requests\Courses\CourseIndexRequest;
use App\Http\Requests\Courses\CourseStoreRequest;
use App\Http\Requests\Courses\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Routing\Controller;

class CourseController extends Controller
{
    public function index(CourseIndexRequest $request)
    {
        return (new CourseControllerHelper)
            ->pagingSearchData($request, new Course(), CourseResource::class);
    }

    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());
        return new CourseResource($course);
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());
        return new CourseResource($course);
    }

    public function destroy($id)
    {
        if (!Course::findOrFail($id)->delete())
            abort(403);
    }
}
