<?php

namespace App\Entities;

class Pedido {
    public $id;
    public $cliente_id;
    public $fecha_pedido;
    public $total;
    public $estado_id;
    public $fecha_modificacion;
    public $active;
}
