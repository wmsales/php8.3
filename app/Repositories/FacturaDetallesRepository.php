<?php

namespace App\Repositories;

use App\Core\Database;

class FacturaDetallesRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'factura_detalles');
    }
}
