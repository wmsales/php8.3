<?php

namespace App\Entities;

class CompraDetalles {
    public $id;
    public $compra_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;
    public $active;
}
