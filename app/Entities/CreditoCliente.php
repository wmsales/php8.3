<?php

namespace App\Entities;

class CreditoCliente {
    public $id;
    public $cliente_id;
    public $credito_total;
    public $credito_utilizado;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $active;
}
