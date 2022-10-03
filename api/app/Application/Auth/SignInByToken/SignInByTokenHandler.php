<?php

declare(strict_types=1);

namespace App\Application\Auth\SignInByToken;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\HandlerInterface;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\User\User;
use App\Models\User\UserFilter;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SignInByTokenHandler
 */
class SignInByTokenHandler implements HandlerInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  SignInByToken  $command
     *
     * @return string
     */
    public function handle(CommandInterface $command): string
    {
        $filter = new UserFilter();
        $filter->setRememberToken($command->getToken());
        /** @var User $user */
        $user = $this->repository->one($filter);

        if (!$user || !Hash::check($user->email.$user->role->type, $command->getToken())) {
            throw new UnprocessableEntityHttpException('Incorrect token');
        }

        $user->remember_token = null;
        $user->save();

        return $user->createToken($user->email)->plainTextToken;
    }
}
