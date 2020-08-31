<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $key => $value) {
            $method = Str::camel($key);
            if (method_exists($this, $method)) {
                $this->$method(...(array)$value);
            }
        }
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return $this->request->get('filter', []);
    }
}
