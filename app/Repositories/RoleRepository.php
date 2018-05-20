<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 31.03.18
 * Time: 0:50
 */

namespace App\Repositories;


use App\Models\Role;

class RoleRepository extends Repository
{
    /**
     * The model associated with the repository.
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Returns an array with roles' levels.
     *
     * @return array
     */
    public function getRoleLevels()
    {
        $data = [];
        foreach (Role::all() as $role) {
            $data[$role->name] = $role->level;
        }
        return $data;
    }
}