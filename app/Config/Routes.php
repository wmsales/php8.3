<?php

use App\Controllers\AuthController;
use App\Controllers\FacturaController;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\PedidoController;

use App\Controllers\ProductoController;
use App\Entities\Factura;
use App\Entities\Producto;
use Symfony\Component\HttpFoundation\Request;

return [
    /**
     * Rutas de la aplicación
     */
    [
        "method" => "GET",
        "uri" => "/home",
        "target" => [HomeController::class, "showHome"],
        "protected" => true,
    ],
    /*
     * Rutas de clientes
     */
    [
        "method" => "GET",
        "uri" => "/clientes",
        "target" => [ClienteController::class, "showIndex"],
        "protected" => true,
    ],
    [
        "method" => "GET",
        "uri" => "/cliente/get/[i:id]",
        "target" => [ClienteController::class, "getCliente"],
        "protected" => true,
    ],
    [
        "method" => "POST",
        "uri" => "/cliente/create",
        "target" => [ClienteController::class, "createCliente"],
        "protected" => true,
    ],
    [
        "method" => "POST",
        "uri" => "/cliente/update",
        "target" => [ClienteController::class, "updateCliente"],
        "protected" => true,
    ],
    [
        "method" => "POST",
        "uri" => "/cliente/delete",
        "target" => [ClienteController::class, "deleteCliente"],
        "protected" => true,
    ],
    /*
     * Rutas de Pedidos
     */
    [
        "method" => "GET",
        "uri" => "/pedidos",
        "target" => [PedidoController::class, "showPedidos"],
        "protected" => true,
    ],
    /*
     * Rutas de Facturacion
     */
    [
        "method" => "GET",
        "uri" => "/facturas",
        "target" => [FacturaController::class, "showFacturas"],
        "protected" => true,
    ],
    /*
     * Rutas de Productos (Articulos)
     */
    [
        "method" => "GET",
        "uri" => "/articulos",
        "target" => [ProductoController::class, "showProductos"],
        "protected" => true,
    ],
    /*
     * Rutas de autenticación
     */
    [
        "method" => "GET",
        "uri" => "/login",
        "target" => function () {
            $request = Request::createFromGlobals();
            (new AuthController())->showLogin();
        },
        "protected" => false,
    ],
    [
        "method" => "POST",
        "uri" => "/login",
        "target" => function () {
            $request = Request::createFromGlobals();
            (new AuthController())->login($request);
        },
        "protected" => false,
    ],
    [
        "method" => "GET",
        "uri" => "/register",
        "target" => function () {
            $request = Request::createFromGlobals();
            (new AuthController())->showRegister();
        },
        "protected" => false,
    ],
    [
        "method" => "POST",
        "uri" => "/register",
        "target" => function () {
            $request = Request::createFromGlobals();
            (new AuthController())->register($request);
        },
        "protected" => false,
    ],
    [
        "method" => "GET",
        "uri" => "/logout",
        "target" => function () {
            (new AuthController())->logout();
        },
        "protected" => true,
    ],
];
