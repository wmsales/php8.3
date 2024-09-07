<?php

namespace App\Repositories;

use App\Core\Database;

class EstadoPedidoRepository extends BaseRepository
{
    public function __construct(Database $database)
    {
        parent::__construct($database, 'estado_pedido');
    }
}
