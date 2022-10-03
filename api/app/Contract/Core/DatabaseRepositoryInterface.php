<?php

namespace App\Contract\Core;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface DatabaseRepositoryInterface
 * @package App\Contract\Core
 */
interface DatabaseRepositoryInterface
{
    /**
     * @param FilterInterface $filter
     * @param PaginationInterface|null $paginator
     * @param SortingInterface|null $sorting
     * @return LengthAwarePaginator|Collection
     */
    public function all(
        FilterInterface $filter,
        ?PaginationInterface $paginator,
        ?SortingInterface $sorting
    );

    /**
     * @param FilterInterface $filter
     * @return Model|null
     */
    public function one(FilterInterface $filter): ?Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function byId(int $id): ?Model;

    /**
     * @param Model $model
     * @return Model
     */
    public function store(Model $model): Model;

    /**
     * @param Model $model
     */
    public function delete(Model $model): void;
}
