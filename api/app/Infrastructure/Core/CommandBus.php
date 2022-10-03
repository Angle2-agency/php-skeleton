<?php

namespace App\Infrastructure\Core;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\CommandBusInterface;
use App\Contract\Core\HandlerInterface;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Class CommandBus
 * @package App\Infrastructure\Core
 */
class CommandBus implements CommandBusInterface
{
    /** @var Container $container */
    private Container $container;

    /**
     * CommandBus constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     * @throws BindingResolutionException
     */
    public function dispatch(CommandInterface $command): mixed
    {
        return $this->findHandler(get_class($command) . 'Handler')
            ->handle($command);
    }


    /**
     * @param string $handlerClass
     * @return HandlerInterface
     * @throws BindingResolutionException
     */
    private function findHandler(string $handlerClass) : HandlerInterface
    {
        return  $this->container->make($handlerClass);
    }
}

