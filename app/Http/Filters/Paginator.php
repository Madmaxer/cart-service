<?php

namespace App\Http\Filters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Paginator
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function paginate(Builder $builder): LengthAwarePaginator
    {
        $count = $this->request->get('per_page');

        return $builder->paginate($count);
    }
}
