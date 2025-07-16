<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'user_id';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'user_id';

    public array $allowedSortKeys = [
        'user_id' => 'members.user_id',
        'finished_at' => 'members.finished_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('user_id')) {
            $model = $model->where('user_id', $request->user_id);
        }
        $model = $model->with('user.cardsPayment');
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            $model->where('user_id', $user->id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
