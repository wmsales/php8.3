<?php

namespace App\Entities;

class FacturaDetalles {
    public $id;
    public $factura_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;
    public $active;
}
