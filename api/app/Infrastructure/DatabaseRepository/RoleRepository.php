<?php

declare(strict_types=1);

namespace App\Infrastructure\DatabaseRepository;

use App\Contract\Core\DatabaseRepositoryInterface;
use App\Contract\Core\FilterInterface;
use App\Contract\Core\SortingInterface;
use App\Models\Role\Role;
use App\Models\Role\RoleFilter;
use App\Models\Role\RoleRepositoryInterface;

class RoleRepository extends DatabaseRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository constructor
     */
    public function __construct()
    {
        $this->model = new Role();
    }

    /**
     * @param RoleFilter $filter
     * @return DatabaseRepositoryInterface
     */
    public function filter(FilterInterface $filter): DatabaseRepositoryInterface
    {
        $this->builder = $this->builder ?? $this->model->newQuery();

        if ($filter->getTitle()) {
            $this->builder->where('title', '=', $filter->getTitle());
        }

        if ($filter->getType()) {
            $this->builder->where('type', '=', $filter->getType());
        }

        return $this;
    }

    /**
     * @param SortingInterface $sorting
     * @return DatabaseRepository
     */
    public function sorting(SortingInterface $sorting): DatabaseRepository
    {
        $this->builder = $this->builder ?? $this->model->newQuery();

        $this->builder->orderBy($sorting->getField(), $sorting->getDirection());

        return $this;
    }
}
