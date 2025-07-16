<?php

namespace App\Http\Controllers;

use App\Helper\ControllersFunctionUtilities;
use App\Helper\ControllersHelpers\Files\MemberControllerHelper;
use App\Http\Requests\FindRequest;
use Illuminate\Routing\Controller;
use App\Http\Requests\Members\MemberIndexRequest;
use App\Http\Requests\Members\MemberStoreRequest;
use App\Http\Requests\Members\MemberUpdateRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(MemberIndexRequest $request)
    {
        return (new MemberControllerHelper)
            ->pagingSearchData($request, new Member(), MemberResource::class);
    }

    public function find(FindRequest $request): JsonResponse
    {
        return (new MemberControllerHelper)
            ->findRecords($request, new Member());
    }

    public function store(MemberStoreRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $member = Member::create($validated_request);
        return new MemberResource($member);
    }

    public function show(Member $member)
    {
        return new MemberResource($member);
    }

    public function update(MemberUpdateRequest $request, Member $member)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $member->update($validated_request);
        return new MemberResource($member);
    }

//    public function destroy($id)
//    {
//        if (!Member::findOrFail($id)->delete())
//            abort(403);
//    }
}
