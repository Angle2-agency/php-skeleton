<?php

declare(strict_types=1);

namespace App\Application\Auth\ForgotPass;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\HandlerInterface;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\User\User;
use App\Models\User\UserFilter;
use Illuminate\Support\Facades\Hash;

/**
 * Class ForgotPassHandler
 */
class ForgotPassHandler implements HandlerInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  ForgotPass  $command
     *
     * @return bool
     */
    public function handle(CommandInterface $command): bool
    {
        $filter = new UserFilter();
        $filter->setEmail($command->getEmail());
        /** @var User $user */
        $user = $this->repository->one($filter);

        $user->remember_token = Hash::make($user->email.$user->role->type);

        //TODO:: Send mail to Email for authentication by token

        return $user->save();
    }
}
