<?php

namespace App\Repositories;

use App\Core\Database;

class PedidoDetallesRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'pedido_detalles');
    }
}