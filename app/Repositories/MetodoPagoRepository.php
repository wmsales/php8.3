<?php

namespace App\Repositories;

use App\Core\Database;

class MetodoPagoRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'metodo_pago');
    }
}
