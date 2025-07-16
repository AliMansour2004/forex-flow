<?php
namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use App\Http\Requests\FindRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'first_name';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'first_name';

    public array $allowedSortKeys = [
        'first_name' => 'users.first_name',
        'last_name' => 'users.last_name',
        'email' => 'users.email',
        'created_at' => 'users.created_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('email')) {
            $model = $model->where('email', 'like', '%' . $request->email . '%');
        }

        return parent::pagingSearchData($request, $model, $resource);
    }

    public function findUserRecord(FindRequest $request, Model|Builder $model, $custom_where = false): JsonResponse
    {
        $per_page = $request->input('per_page', 6);
        $term = $request->input('term', '');
        $searchColumn = $this->findColumn;

        if (!$custom_where) {
            $model = $model->where($searchColumn, 'like', '%' . $term . '%');
//            $model = $model->where(function ($query) use ($term) {
//                $query->where('first_name', 'like', '%' . $term . '%')
//                    ->orWhere('middle_name', 'like', '%' . $term . '%')
//                    ->orWhere('last_name', 'like', '%' . $term . '%');
//            });
        }

        $records = $model->paginate($per_page);

        $current_page = $records->currentPage();
        $lastPage = $records->lastPage();
        $morePages = $current_page < $lastPage;

        $items = [];

        foreach ($records as $record) {
            $fullName = trim($record->first_name . ' ' . ($record->middle_name ?? '') . ' ' . $record->last_name);

            $item = [
                'id' => $record->id,
                'name' => $fullName,
            ];
            $items[] = $item;
        }

        $response = [
            'pagination' => [
                'more' => $morePages,
                'current_page' => $current_page,
                'last_page' => $lastPage,
            ],
            'data' => $items,
        ];

        return response()->json($response);
    }

}
