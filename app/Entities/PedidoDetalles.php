<?php

namespace App\Entities;

class PedidoDetalles {
    public $id;
    public $pedido_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $subtotal;
    public $active;
}
