<?php

namespace App\Entities;

class Factura {
    public $id;
    public $cliente_id;
    public $fecha_factura;
    public $total;
    public $pedido_id;
    public $uuid;
    public $numero_serie;
    public $numero_factura;
    public $fecha_modificacion;
    public $active;
}
