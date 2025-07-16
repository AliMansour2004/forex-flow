<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class MemberSubscriptionControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'user_id';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'user_id';

    public array $allowedSortKeys = [
        'user_id' => 'members_subscriptions.user_id',
        'finished_at' => 'members_subscriptions.finished_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('user_id')) {
            $model = $model->where('user_id', $request->user_id);
        }

        if ($request->filled('finished_at')) {
            $model = $model->whereDate('finished_at', $request->finished_at);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
