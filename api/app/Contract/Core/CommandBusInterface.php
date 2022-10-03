<?php

namespace App\Contract\Core;

/**
 * Class CommandBusInterface
 * @package App\Contract\Core
 */
interface CommandBusInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function dispatch(CommandInterface $command);
}
