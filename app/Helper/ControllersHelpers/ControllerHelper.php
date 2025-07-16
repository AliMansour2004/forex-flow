<?php

namespace App\Helper\ControllersHelpers;

use App\Http\Requests\FindRequest;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ControllerHelper
{
    protected string $defaultSortKey = '';
    protected string $defaultSortDirection = 'asc';
    protected string $findColumn = '';
    protected array $allowedSortKeys = [];

    /**
     * @param FormRequest $request
     * @param Model|Builder $model
     * @param $resource
     * @return array
     * @throws Exception
     */
    function pagingSearchData(FormRequest $request, Model|Builder $model, $resource): array
    {
        $model = $this->setSorting($model, $request);
        $model = $this->searchData($model, $request);
//        dd($model->toSql()); // => DEBUG

        //  $model->selectRaw('tbl.*'); // => SELECT COLUMNS

        $pageSize = $request->input('per_page', 10);
        $results = $model->paginate($pageSize);

        return [
            'meta' => [
                'current_page' => $results->currentPage(),
                'total' => $results->total(),
                'last_page' => $results->lastPage(),
            ],
            'data' => $resource::collection($results),
        ];
    }

    /**
     * @throws Exception
     */
    protected function setSorting($model, $request)
    {
        if ($request->filled('sortKey')) {
            if (!$request->filled('sortDirection'))
                if ($this->defaultSortDirection != '')
                    $sortDirection = $this->defaultSortDirection;
                else
                    $sortDirection = 'asc';
            else
                $sortDirection = $request->get('sortDirection');
            $sortKey = $request->get('sortKey');

//            if ($sortKey == '1') $sortKey = 'id'; // <= mapping keys

            if (count($this->allowedSortKeys) > 0) {
                $allowedSortKeys = $this->allowedSortKeys;
                if (!array_key_exists($sortKey, $allowedSortKeys))
                    throw new Exception('Invalid sort key', 400);

                // Get the corresponding column name for sorting
                $sortKey = $allowedSortKeys[$sortKey];
            }
        } else { // Default Sorting
            $sortKey = $this->defaultSortKey;
            $sortDirection = $this->defaultSortDirection;
        }
        return $model->orderBy($sortKey, $sortDirection);
    }

    /**
     * @param Model|Builder $model
     * @param object $request
     * @param bool $is_export_excel
     * @return Model|Builder
     * @throws Exception
     */
    function searchData(Model|Builder $model, object $request, bool $is_export_excel = false): Model|Builder
    {
        if ($is_export_excel) {
            $model = $this->setSorting($model, $request);
        }

        // => SEARCH FIELDS
        if ($request->filled('id'))
            $model->whereIn('id', $request->id);

//        $model = $model->whereHas('meters', function ($query) use ($project_id) {
//            $query->where('project_id', $project_id);
//        });

//        $model->where(['project_id', $project_id]);

        return $model;
    }

    public function findRecords(FindRequest $request, Model|Builder $model, $custom_where = false): JsonResponse
    {
        $per_page = $request->input('per_page', 6);
        $term = $request->input('term', '');
        $searchColumn = $this->findColumn;

        if (!$custom_where) {
            $model = $model->where($searchColumn, 'like', '%' . $term . '%');
        }

        $records = $model->paginate($per_page);

        $current_page = $records->currentPage();
        $lastPage = $records->lastPage();
        $morePages = $current_page < $lastPage;

        $items = [];

        foreach ($records as $record) {
            $item = [
                'id' => $record->id,
                'name' => $record->$searchColumn,
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
