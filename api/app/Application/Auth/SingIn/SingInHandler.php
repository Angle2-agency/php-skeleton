<?php

declare(strict_types=1);

namespace App\Application\Auth\SingIn;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\HandlerInterface;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\User\User;
use App\Models\User\UserFilter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class SingInHAndler
 */
class SingInHandler implements HandlerInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  SingIn  $command
     *
     * @return string
     */
    public function handle(CommandInterface $command): string
    {
        $filter = new UserFilter();
        $filter->setEmail($command->getEmail());
        /** @var User $user */
        $user = $this->repository->one($filter);

        if (!$user || !Hash::check($command->getPassword(), $user->password)) {
            throw new UnauthorizedException('Email or password is wrong');
        }

        return $user->createToken($user->email)->plainTextToken;
    }
}
