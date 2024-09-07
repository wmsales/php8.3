<?php

namespace App\Repositories;

use App\Core\Database;

class TipoMovimientoRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'tipo_movimiento');
    }
}
