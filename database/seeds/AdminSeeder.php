<?php

use App\Models\Education;
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
            'name'          => 'admin',
            'surname'       => 'admin',
            'email'         => 'admin@admin.com',
            'password'      => 'admin1',
            'position'      => 'senior',
            'department'    => 'admin'
            ];

        $infodata = [
            'location'      => 'Харьков',
            'phone'         => '10101010'
        ];

        $admin = User::firstOrCreate($data);

        $adminRole = Role::find(Role::ID_ADMINISTRATOR);

        $admin->attachRole($adminRole);

        $info = $admin->info()->firstOrNew([]);

        $info->fill($infodata);
        $info->save();
    }
}
