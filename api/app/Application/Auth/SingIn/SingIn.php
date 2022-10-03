<?php

declare(strict_types=1);

namespace App\Application\Auth\SingIn;

use App\Contract\Core\CommandInterface;

/**
 * Class SingIn
 */
class SingIn implements CommandInterface
{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
