<?php

namespace App\Controllers;
use App\Core\HttpHelper;

class PedidoController extends ViewController
{
    /**
     * Muestra la vista de pedidos
     */
    public function showPedidos()
    {
        $contentHtml = $this->render("modules/pedidos/index", [
            "titulo" => "Pedidos",
            "botones" => [
                [
                    "nombre" => "Crear Pedido",
                    "url" => "/pedido/create",
                    "icono" => "fas fa-plus",
                ],
            ],
            "html" => "
                <table class='table table-striped table-bordered'>
                    <thead class='table-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Cliente 1</td>
                            <td>2021-09-01</td>
                            <td>Enviado</td>
                            <td>
                                <a href='/pedido/get/1' class='btn btn-primary'>
                                    <i class='fas fa-eye fa-sm'></i>
                                </a>
                                <a href='/pedido/update/1' class='btn btn-warning'>
                                    <i class='fas fa-edit fa-sm'></i>
                                </a>
                                <a href='/pedido/delete/1' class='btn btn-danger'>
                                    <i class='fas fa-trash fa-sm'></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            ",
        ]);
    }
}
