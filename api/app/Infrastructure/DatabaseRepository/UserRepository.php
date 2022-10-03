<?php

declare(strict_types=1);

namespace App\Infrastructure\DatabaseRepository;

use App\Contract\Core\DatabaseRepositoryInterface;
use App\Contract\Core\FilterInterface;
use App\Contract\Core\SortingInterface;
use App\Models\User\User;
use App\Models\User\UserFilter;
use App\Models\User\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Infrastructure\DatabaseRepository
 */
class UserRepository extends DatabaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param UserFilter $filter
     * @return DatabaseRepositoryInterface
     */
    public function filter(FilterInterface $filter): DatabaseRepositoryInterface
    {
        $this->builder = $this->builder ?? $this->model->newQuery();

        if ($filter->getEmail()) {
            $this->builder->where('email', '=', $filter->getEmail());
        }

        if ($filter->getName()) {
            $this->builder->where('name', '=', $filter->getName());
        }

        if ($filter->getRememberToken()) {
            $this->builder->where('remember_token', '=', $filter->getRememberToken());
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
