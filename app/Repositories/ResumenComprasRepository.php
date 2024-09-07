<?php

namespace App\Repositories;

use App\Core\Database;

class ResumenComprasRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'resumen_compras');
    }
}
