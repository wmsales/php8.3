<?php

namespace App\Repositories;

use App\Core\Database;

class ClienteRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'cliente');
    }
}