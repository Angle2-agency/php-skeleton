<?php

declare(strict_types=1);

namespace App\Application\Auth\ForgotPass;

use App\Contract\Core\CommandInterface;

/**
 * Class ForgotPass
 */
class ForgotPass implements CommandInterface
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
