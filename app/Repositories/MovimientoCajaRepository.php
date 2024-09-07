<?php

namespace App\Repositories;

use App\Core\Database;

class MovimientoCajaRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'movimiento_caja');
    }
}
