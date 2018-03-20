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
}