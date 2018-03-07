<?php

namespace Database\Seeds;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => Role::ID_ADMINISTRATOR,
                'name'  => Role::ADMINISTRATOR,
                'slug'  => Role::ADMINISTRATOR,
                'level' => Role::LEVEL_ADMINISTRATOR,
            ], [
                'id'    => Role::ID_MODERATOR,
                'name'  => Role::MODERATOR,
                'slug'  => Role::MODERATOR,
                'level' => Role::LEVEL_MODERATOR,
            ], [
                'id'    => Role::ID_EMPLOYEE,
                'name'  => Role::EMPLOYEE,
                'slug'  => Role::EMPLOYEE,
                'level' => Role::LEVEL_EMPLOYEE,
            ], [
                'id'    => Role::ID_CANDIDATE,
                'name'  => Role::CANDIDATE,
                'slug'  => Role::CANDIDATE,
                'level' => Role::LEVEL_CANDIDATE,
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
