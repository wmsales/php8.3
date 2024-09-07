<?php

use App\Controllers\ClienteController;

return [
    [
        'method' => 'GET',
        'uri' => '/home',
        'target' => function() {
            include __DIR__ . '/../Views/home/home.php';
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/clientes',
        'target' => [ClienteController::class, 'listClientes']
    ],
];
