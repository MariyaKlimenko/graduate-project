<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 19.03.18
 * Time: 22:07
 */

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    /**
     * The model associated with the repository.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Returns data for users' datatable.
     *
     * @return mixed
     */
    public function getUserDataTableData()
    {
        $users = User::join('info', 'users.id', '=', 'info.user_id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.surname',
                'users.position',
                'users.department',
                'info.location',
                'info.updated_at',
                'roles.level',
                'roles.name as role_name'
            )->get();

        return $users->each(function ($user) {
            $role = trans('roles.' . $user->role_name);

            $user->role_name = $role;
        });
    }
}