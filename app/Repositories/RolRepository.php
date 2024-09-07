<?php

namespace App\Repositories;

use App\Core\Database;

class RolRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'rol');
    }
}
