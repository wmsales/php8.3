<?php

namespace App\Repositories;

use App\Core\Database;

class CompraDetallesRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'compra_detalles');
    }
}
