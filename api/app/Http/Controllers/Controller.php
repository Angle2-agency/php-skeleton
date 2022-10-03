<?php

namespace App\Http\Controllers;

use App\Contract\Core\CommandBusInterface;
use App\Contract\Core\CommandInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var CommandBusInterface $dispatcher */
    protected CommandBusInterface $dispatcher;

    /**
     * Controller constructor.
     *
     * @param CommandBusInterface $dispatcher
     */
    public function __construct(CommandBusInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function execute(CommandInterface $command)
    {
        return $this->dispatcher->dispatch($command);
    }
}
