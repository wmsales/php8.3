<?php

namespace App\Entities;

class PagoProveedor {
    public $id;
    public $factura_proveedor_id;
    public $metodo_pago_id;
    public $monto;
    public $fecha_pago;
    public $active;
}