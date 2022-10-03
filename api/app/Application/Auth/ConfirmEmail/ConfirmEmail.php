<?php

declare(strict_types=1);

namespace App\Application\Auth\ConfirmEmail;

use App\Contract\Core\CommandInterface;

/**
 * Class ConfirmEmail
 */
class ConfirmEmail implements CommandInterface
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
