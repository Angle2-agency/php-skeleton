<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contract\Core\CommandBusInterface;
use App\Contract\Services\MailServiceInterface;
use App\Infrastructure\Core\CommandBus;
use App\Infrastructure\Services\MailService;
use Illuminate\Support\ServiceProvider;

/**
 * Class CoreServiceProvider
 * @package App\Providers
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MailServiceInterface::class, MailService::class);
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(CommandBusInterface::class, CommandBus::class);
    }
}
