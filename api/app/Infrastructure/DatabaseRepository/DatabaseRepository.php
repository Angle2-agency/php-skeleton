<?php

namespace App\Infrastructure\DatabaseRepository;

use App\Contract\Core\FilterInterface;
use App\Contract\Core\PaginationInterface;
use App\Contract\Core\SortingInterface;
use App\Contract\Core\DatabaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Exception;

/**
 * Class StorageDatabaseRepository
 * @package App\Infrastructure\StorageRepository
 */
abstract class DatabaseRepository implements DatabaseRepositoryInterface
{
    /** @var Model $model */
    protected Model $model;

    /** @var Builder $builder */
    protected Builder $builder;

    /**
     * DatabaseRepository constructor
     */
    abstract public function __construct();

    /**
     * @param FilterInterface $filter
     */
    abstract protected function filter(FilterInterface $filter): DatabaseRepositoryInterface;

    /**
     * @param SortingInterface $sorting
     */
    abstract protected function sorting(SortingInterface $sorting): DatabaseRepositoryInterface;

    /**
     * @param FilterInterface $filter
     * @param PaginationInterface|null $paginator
     * @param SortingInterface|null $sorting
     * @return LengthAwarePaginator|Collection
     */
    public function all(
        FilterInterface $filter,
        ?PaginationInterface $paginator = null,
        ?SortingInterface $sorting = null
    ) {
        $this->builder = $this->model->newQuery();
        $this->filter($filter);

        if ($sorting) {
            $this->sorting($sorting);
        }

        if ($paginator) {
            return $this->builder->paginate($paginator->getPerPage(), ['*'], 'page', $paginator->getPage());
        }

        return $this->builder->get();
    }

    /**
     * @param FilterInterface $filter
     * @return Model|null
     */
    public function one(FilterInterface $filter): ?Model
    {
        $this->builder = $this->model->newQuery();
        $this->filter($filter);

        return $this->builder->first();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function byId(int $id): ?Model
    {
        $this->builder = $this->model->newQuery();

        return $this->builder->findOrFail($id);
    }

    /**
     * @param Model $model
     * @return Model
     * @throws Exception
     */
    public function store(Model $model): Model
    {
        if (!$model->save()) {
            throw new Exception(
                sprintf("Object %s with id %s not saved", Model::class, $model->id)
            );
        }

        return $model;
    }

    /**
     * @param Model $model
     * @throws Exception
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }
}
