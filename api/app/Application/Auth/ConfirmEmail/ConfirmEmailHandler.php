<?php

declare(strict_types=1);

namespace App\Application\Auth\ConfirmEmail;

use App\Contract\Core\CommandInterface;
use App\Contract\Core\HandlerInterface;
use App\Infrastructure\DatabaseRepository\UserRepository;
use App\Models\User\User;
use App\Models\User\UserFilter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ConfirmEmailHandler
 */
class ConfirmEmailHandler implements HandlerInterface
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  ConfirmEmail  $command
     *
     * @return bool
     */
    public function handle(CommandInterface $command): bool
    {
        $filter = new UserFilter();
        $filter->setRememberToken($command->getToken());
        /** @var User $user */
        $user = $this->repository->one($filter);

        if (!$user || !Hash::check($user->email.$user->password, $command->getToken())) {
            throw new UnprocessableEntityHttpException('Incorrect token');
        }

        $user->remember_token = null;
        $user->email_verified_at = Carbon::now();

        return $user->save();
    }
}
