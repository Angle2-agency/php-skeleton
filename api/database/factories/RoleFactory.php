<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'type' => $this->faker->name,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => Role::ROLE_ADMIN,
            'type' => Role::ROLE_ADMIN,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => Role::ROLE_USER,
            'type' => Role::ROLE_USER,
        ]);
    }
}