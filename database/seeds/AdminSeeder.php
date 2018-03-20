<?php

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
        $data = [
            'name'      => 'admin',
            'surname'   => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => 'admin1',
            ];

        $admin = User::firstOrCreate($data);

        $adminRole = Role::find(Role::ID_ADMINISTRATOR);

        $admin->attachRole($adminRole);

        $info = $admin->info()->firstOrNew([]);
        $info->save();
    }
}
