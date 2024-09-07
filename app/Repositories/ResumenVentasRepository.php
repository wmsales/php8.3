<?php

namespace App\Repositories;

use App\Core\Database;

class ResumenVentasRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'resumen_ventas');
    }
}
