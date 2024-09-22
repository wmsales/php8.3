<?php

namespace App\Controllers;

class FacturaController extends ViewController
{
    // Add your controller methods here
    public function showFacturas()
    {
        $contentHtml = $this->render("modules/facturas/index", [
            "titulo" => "Facturacion",
            "botones" => [
                [
                    "nombre" => "Crear Factura",
                    "url" => "/factura/create",
                    "icono" => "fas fa-plus",
                ],
            ],
            "html" => "
            <h1>Facturas</h1>
            <div class=\"card\" style=\"width: 18rem;\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Factura 1</h5>
                    <h6 class=\"card-subtitle mb-2 text-muted\">Cliente 1</h6>
                    <p class=\"card-text\">Fecha: 2021-09-01</p>
                    <p class=\"card-text\">Total: $100.00</p>
                    <a href='/factura/get/1' class='btn btn-primary'>
                        <i class='fas fa-eye fa-sm'></i>
                    </a>
                </div>
            </div>
            ",
        ]);
    }
}
