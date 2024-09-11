<?php

namespace App\Entities;

class FacturaProveedorDetalles {
    public $id;
    public $factura_proveedor_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;
    public $active;
}