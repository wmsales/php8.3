<?php

namespace App\Repositories;

use App\Core\Database;

class CreditoClienteRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'credito_cliente');
    }
}
