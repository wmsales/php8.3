<?php

namespace App\Entities;

class Factura {
    public $id;
    public $cliente_id;
    public $fecha_factura;
    public $total;
    public $pedido_id;
    public $fecha_modificacion;
    public $active;
}
