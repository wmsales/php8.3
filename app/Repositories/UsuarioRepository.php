<?php

namespace App\Repositories;

use App\Core\Database;

class UsuarioRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'usuario');
    }
}
