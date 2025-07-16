<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\MemberCommissionControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\MembersCommissions\MemberCommissionIndexRequest;
use App\Http\Requests\MembersCommissions\MemberCommissionStoreRequest;
use App\Http\Requests\MembersCommissions\MemberCommissionUpdateRequest;
use App\Http\Resources\MemberCommissionResource;
use App\Models\MemberCommission;

class MemberCommissionController extends Controller
{
    public function index(MemberCommissionIndexRequest $request)
    {
        return (new MemberCommissionControllerHelper)
            ->pagingSearchData($request, new MemberCommission(), MemberCommissionResource::class);
    }

    public function store(MemberCommissionStoreRequest $request)
    {
        $membersCommission = MemberCommission::create($request->validated());
        return new MemberCommissionResource($membersCommission);
    }

    public function show(MemberCommission $membersCommission)
    {
        return new MemberCommissionResource($membersCommission);
    }

    public function update(MemberCommissionUpdateRequest $request, MemberCommission $membersCommission)
    {
        $membersCommission->update($request->validated());
        return new MemberCommissionResource($membersCommission);
    }

    public function destroy($id)
    {
        if (!MemberCommission::findOrFail($id)->delete())
            abort(403);
    }
}
