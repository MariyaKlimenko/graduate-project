<?php

namespace App\Models;

use Ultraware\Roles\Models\Role as Model;

class Role extends Model
{
    const ID_ADMINISTRATOR  = 1;
    const ID_MODERATOR      = 2;
    const ID_EMPLOYEE       = 3;
    const ID_CANDIDATE      = 4;

    const ADMINISTRATOR     = 'administrator';
    const MODERATOR         = 'moderator';
    const EMPLOYEE          = 'employee';
    const CANDIDATE         = 'candidate';

    const LEVEL_ADMINISTRATOR   = 4;
    const LEVEL_MODERATOR       = 3;
    const LEVEL_EMPLOYEE        = 2;
    const LEVEL_CANDIDATE       = 1;
}
