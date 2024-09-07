<?php

namespace App\Config;

return [
    [
        'nombre' => 'Inicio',
        'descripcion' => 'Página principal del ERP',
        'icono' => 'fas fa-home',
        'roles' => ['ADMIN', 'GERENCIA', 'VENTAS', 'BODEGA'],
        'hijos' => [
            [
                'nombre' => 'Home',
                'descripcion' => 'Vista de inicio',
                'ruta' => '/home',
                'vista' => 'home/home.php',
                'icono' => 'fas fa-house-user',
                'roles' => ['ADMIN', 'GERENCIA', 'VENTAS', 'BODEGA']
            ]
        ]
    ],
    [
        'nombre' => 'Clientes',
        'descripcion' => 'Modulos relacionados con los clientes',
        'icono' => 'fas fa-home',
        'roles' => ['ADMIN', 'GERENCIA', 'VENTAS'],
        'hijos' => [
            [
                'nombre' => 'Clientes',
                'descripcion' => 'Gestión de clientes',
                'ruta' => '/clientes',
                'vista' => 'modules/clientes.php',
                'icono' => 'fa-solid fa-users',
                'roles' => ['ADMIN', 'GERENCIA', 'VENTAS']
            ],
    ]
    ],
    [
        'nombre' => 'Ventas',
        'descripcion' => 'Módulos relacionados con las ventas',
        'icono' => 'fas fa-shopping-bag',
        'roles' => ['ADMIN', 'GERENCIA', 'VENTAS'],
        'hijos' => [
            [
                'nombre' => 'Pedidos',
                'descripcion' => 'Gestión de pedidos',
                'ruta' => '/pedidos',
                'vista' => 'modules/pedidos.php',
                'icono' => 'fa-solid fa-file',
                'roles' => ['ADMIN', 'GERENCIA', 'VENTAS']
            ],
            [
                'nombre' => 'Facturación',
                'descripcion' => 'Módulo de facturación',
                'ruta' => '/facturas',
                'vista' => 'modules/facturacion.php',
                'icono' => 'fa-solid fa-file-invoice',
                'roles' => ['ADMIN', 'GERENCIA']
            ]
        ]
    ],
    [
        'nombre' => 'Inventario',
        'descripcion' => 'Módulos relacionados con los productos y el inventario',
        'icono' => 'fas fa-box',
        'roles' => ['ADMIN', 'BODEGA'],
        'hijos' => [
            [
                'nombre' => 'Productos',
                'descripcion' => 'Gestión de productos',
                'ruta' => '/productos',
                'vista' => 'modules/productos.php',
                'icono' => 'fa-solid fa-boxes-stacked',
                'roles' => ['ADMIN', 'BODEGA']
            ]
        ]
    ]
];
