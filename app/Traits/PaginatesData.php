<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

trait PaginatesData
{
    /**
     * Paginate query dengan search & Bootstrap 5.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $searchable  Kolom yang bisa dicari
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function paginateData($query, Request $request, array $searchable = [], int $perPage = 10)
    {
        Paginator::useBootstrapFive();

        $search = $request->input('search');

        if ($search && !empty($searchable)) {
            $query->where(function ($q) use ($search, $searchable) {
                foreach ($searchable as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        return $query->latest()->paginate($perPage)->withQueryString();
    }
}
