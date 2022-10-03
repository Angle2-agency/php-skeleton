<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Contract\Core\FilterInterface;
use Illuminate\Http\Request;

/**
 * Class UserFilter
 */
class UserFilter implements FilterInterface
{
    private ?string $name = null;
    private ?string $email = null;
    private ?string $remember_token = null;

    public static function fromRequest(Request $request): FilterInterface
    {
        $filter = new self();
        $filter->setEmail($request->get('email'));
        $filter->setName($request->get('name'));
        $filter->setRememberToken($request->get('remember_token'));

        return $filter;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  string|null  $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param  string|null  $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->remember_token;
    }

    /**
     * @param  string|null  $remember_token
     */
    public function setRememberToken(?string $remember_token): void
    {
        $this->remember_token = $remember_token;
    }
}
