<?php

namespace Tests;

use App\Contract\Core\CommandBusInterface;
use App\Contract\Core\CommandInterface;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    use WithFaker;

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function execute(CommandInterface $command): mixed
    {
        return $this->app->make(CommandBusInterface::class)->dispatch($command);
    }

    /**
     * @param  User|null  $admin
     *
     * @return TestCase
     */
    protected function actingAsAdmin(?User $admin = null): TestCase
    {
        if (!$admin) {
            $admin = Role::query()
                ->where('type', Role::ROLE_ADMIN)
                ->first()
                ->users()
                ->first();
        }

        return $this->actingAs($admin);
    }

    /**
     * @param  User|null  $user
     *
     * @return TestCase
     */
    protected function actingAsUser(?User $user = null): TestCase
    {
        if (!$user) {
            $user = Role::query()
                ->where('type', Role::ROLE_USER)
                ->first()
                ->users()
                ->first();
        }

        return $this->actingAs($user);
    }

    /**
     * @return User
     */
    public function getAdmin(): User
    {
        return Role::query()
            ->where('type', Role::ROLE_ADMIN)
            ->first()
            ->users()
            ->first();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return Role::query()
            ->where('type', Role::ROLE_USER)
            ->first()
            ->users()
            ->first();
    }
}
