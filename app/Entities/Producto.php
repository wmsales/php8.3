<?php

namespace App\Entities;

class Producto {
    public $id;
    public $sku;
    public $codigo_barras;
    public $nombre;
    public $descripcion;
    public $costo;
    public $precio_publico;
    public $precio_mayorista;
    public $precio_super_mayorista;
    public $stock_minimo;
    public $stock_maximo;
    public $stock_actual;
    public $inventario_negativo;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $active;
}
