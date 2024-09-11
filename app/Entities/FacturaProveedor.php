<?php

namespace App\Entities;

class FacturaProveedor {
    public $id;
    public $proveedor_id;
    public $uuid;
    public $numero_serie;
    public $numero_factura;
    public $fecha_factura;
    public $total;
    public $estado_pago_id;
    public $fecha_modificacion;
    public $active;
}
