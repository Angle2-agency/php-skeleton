<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

/**
 * Trait UserTrait
 */
trait UserTrait
{
    public function setRememberToken(User $user): User
    {
        $user->remember_token = Hash::make($user->email.$user->role->type);
        $user->save();

        return $user;
    }

    public function setConfirmationToken(User $user): User
    {
        $user->remember_token = Hash::make($user->email.$user->password);
        $user->save();

        return $user;
    }
}
