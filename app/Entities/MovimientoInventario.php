<?php

namespace App\Entities;

class MovimientoInventario {
    public $id;
    public $producto_id;
    public $tipo_movimiento_id;
    public $cantidad;
    public $descripcion;
    public $usuario_id;
    public $fecha_movimiento;
    public $active;
}
