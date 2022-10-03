<?php

namespace App\Contract\Core;

/**
 * Interface HandlerInterface
 * @package App\Contract\Core
 */
interface HandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function handle(CommandInterface $command);
}
