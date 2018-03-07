<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'      => 'admin',
            'surname'   => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('admin1'),
            ];

        User::firstOrCreate($user);

        $admin = User::where('email', 'admin@admin.com')->first();
        $adminRole = Role::find(Role::ID_ADMINISTRATOR);

        $admin->attachRole($adminRole);
    }
}
