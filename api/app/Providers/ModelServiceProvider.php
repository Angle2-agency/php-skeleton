<?php

declare(strict_types=1);

namespace App\Providers;

use App\Infrastructure\DatabaseRepository\RoleRepository;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\Role\RoleRepositoryInterface;
use App\Models\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class DomainServiceProvider
 * @package App\Providers
 */
class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
    }
}
