<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::find(Role::ID_EMPLOYEE);
        $moderatorRole = Role::find(Role::ID_MODERATOR);


        $data = [
            'name'          => 'Masha',
            'surname'       => 'Klimenko',
            'email'         => 'mashak@email.com',
            'password'      => '111111',
            'position'      => 'Intern',
            'department'    => 'Web Solutions'
        ];

        $infoData = [
            'location'      => 'Харьков',
            'phone'         => '343535'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($moderatorRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Igor',
            'surname'       => 'Pehov',
            'email'         => 'ipehov@email.com',
            'password'      => '111111',
            'position'      => 'Junior Software Developer',
            'department'    => 'Web Solutions'
        ];

        $infoData = [

            'location'      => 'Харьков',
            'phone'         => '1121235'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($moderatorRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Alina',
            'surname'       => 'Fomenko',
            'email'         => 'afomenko@email.com',
            'password'      => '111111',
            'position'      => 'Middle Software Developer',
            'department'    => 'Web Solutions'
        ];
        $infoData = [
            'location'      => 'Киев',
            'phone'         => '989898'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'John',
            'surname'       => 'Doe',
            'email'         => 'johndoe@email.com',
            'password'      => '111111',
            'position'      => 'Senior Software Developer',
            'department'    => 'Web Solutions'
        ];
        $infoData = [
            'location'      => 'Киев',
            'phone'         => '76767676'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Jane',
            'surname'       => 'Doe',
            'email'         => 'janedoe@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'frontend'
        ];
        $infoData = [
            'location'      => 'Львов',
            'phone'         => '545454'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Osvald',
            'surname'       => 'Cobblepot',
            'email'         => 'penguin@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'frontend'
        ];
        $infoData = [
            'location'      => 'Харьков',
            'phone'         => '1111111'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Edward',
            'surname'       => 'Nygma',
            'email'         => 'enigma@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'riddler'
        ];

        $infoData = [
            'location'      => 'Харьков',
            'phone'         => '7777777'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Jerome',
            'surname'       => 'Valeska',
            'email'         => 'jocker@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'javascript'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '66666656'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Jim',
            'surname'       => 'Gordon',
            'email'         => 'jgordon@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'java'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '900767676'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Harvey',
            'surname'       => 'Bullock',
            'email'         => 'hbullock@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'java'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '43437676'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();
        $data = [
            'name'          => 'Evy',
            'surname'       => 'Pepper',
            'email'         => 'poisonevy@email.com',
            'password'      => '111111',
            'position'      => 'junior',
            'department'    => 'frontend'
        ];

        $infoData = [
            'location'      => 'Львов',
            'phone'         => '656565'
        ];
        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Selina',
            'surname'       => 'Kyle',
            'email'         => 'cat@email.com',
            'password'      => '111111',
            'position'      => 'junior',
            'department'    => 'javascript'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '7999999'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();
        $data = [
            'name'          => 'Bruce',
            'surname'       => 'Wayne',
            'email'         => 'batman@email.com',
            'password'      => '111111',
            'position'      => 'junior',
            'department'    => 'php'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '333333'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Lee',
            'surname'       => 'Tompkins',
            'email'         => 'lesly@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'javascript'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '77777676'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Butch',
            'surname'       => 'Geelzean',
            'email'         => 'butch@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'c sharp'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '454545'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();

        $data = [
            'name'          => 'Barbara',
            'surname'       => 'Keen',
            'email'         => 'barbara@email.com',
            'password'      => '111111',
            'position'      => 'senior',
            'department'    => 'HR'
        ];

        $infoData = [
            'location'      => 'Киев',
            'phone'         => '76543369'
        ];

        $user = User::firstOrCreate($data);
        $user->attachRole($userRole);
        $info = $user->info()->firstOrNew([]);
        $info->fill($infoData);
        $info->save();
    }
}
