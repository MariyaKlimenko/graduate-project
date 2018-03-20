<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 20.03.18
 * Time: 19:50
 */

namespace App\Repositories;

use App\Models\Info;

class InfoRepository extends Repository
{
    /**
     * The model associated with the repository.
     *
     * @return string
     */
    public function model()
    {
        return Info::class;
    }
}