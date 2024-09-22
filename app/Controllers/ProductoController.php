<?php

namespace App\Controllers;

class ProductoController extends ViewController
{
    // Add your controller methods here
    public function showProductos()
    {
        $contentHtml = $this->render("modules/articulos/index", [
            "titulo" => "Artículos",
        ]);
    }
}
