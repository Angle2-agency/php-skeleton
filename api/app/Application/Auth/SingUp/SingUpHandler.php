<?php

declare(strict_types=1);

namespace App\Application\Auth\SingUp;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\HandlerInterface;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Exception;

/**
 * Class SingUpHandler
 */
class SingUpHandler implements HandlerInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  SingUp  $command
     *
     * @return string
     * @throws Exception
     */
    public function handle(CommandInterface $command): string
    {
        $user = new User([
            'email' => $command->getEmail(),
            'name' => $command->getName(),
        ]);
        $user->password = Hash::make($user->password);
        $user->remember_token = Hash::make($user->email.$user->password);
        /** @var User $user */
        $user = $this->repository->store($user);

        return $user->createToken($user->email)->plainTextToken;
    }
}
