<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::factory()->admin()->create();
        Role::factory()->user()->create();
    }
}
