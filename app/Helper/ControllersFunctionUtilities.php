<?php

namespace App\Helper;

use App\Models\MemberSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ControllersFunctionUtilities
{


    public static function applySort($query, $sortKey, $sortDirection = 'asc')
    {
        if ($sortKey) {
            $query->orderBy($sortKey, $sortDirection);
        }
    }

    public static function paginateQuery($query, $perPage, $total)
    {
        return $query->paginate($perPage, '*', 'page', '', $total);
    }


    public static function applyDateRangeFilter($request, Builder $query, $column)
    {
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $query->whereBetween($column, [$startDate, $endDate]);
        } elseif ($request->filled('start_date')) {
            $startDate = $request->start_date;
            $query->where($column, '>=', $startDate);
        } elseif ($request->filled('end_date')) {
            $endDate = $request->end_date;
            $query->where($column, '<=', $endDate);
        }
    }

    public static function findRecords(Request $request, Model $model, $searchColumn = 'name'): \Illuminate\Http\JsonResponse
    {

        $request->validate([
            'per_page' => 'nullable|integer|min:1',
            'term' => 'nullable|string',
        ]);


        $per_page = $request->input('per_page', 6);
        $term = $request->input('term', '');


        $query = $model->where($searchColumn, 'like', '%' . $term . '%');


        $records = $query->paginate($per_page);


        $current_page = $records->currentPage();
        $lastPage = $records->lastPage();
        $morePages = $current_page < $lastPage;

        $items = [];

        foreach ($records as $record) {
            $item = [
                'id' => $record->id,
                $searchColumn => $record->$searchColumn,
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
