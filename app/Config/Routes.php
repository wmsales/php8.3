<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;

use Symfony\Component\HttpFoundation\Request;

return [
    [
        'method' => 'GET',
        'uri' => '/home',
        'target' => [HomeController::class, 'showHome'],
        'protected' => true
    ],
    [
        'method' => 'GET',
        'uri' => '/clientes',
        'target' => [ClienteController::class, 'showIndex'],
        'protected' => true
    ],
    [
        'method' => 'POST',
        'uri' => '/clientes/create',
        'target' => [ClienteController::class, 'createCliente'],
        'protected' => true
    ],
    [
        'method' => 'POST',
        'uri' => '/clientes/update',
        'target' => [ClienteController::class, 'updateCliente'],
        'protected' => true
    ],
    [
        'method' => 'POST',
        'uri' => '/clientes/delete',
        'target' => [ClienteController::class, 'deleteCliente'],
        'protected' => true
    ],
    [
        'method' => 'GET',
        'uri' => '/login',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->showLogin();
        },
        'protected' => false
    ],
    [
        'method' => 'POST',
        'uri' => '/login',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->login($request);
        },
        'protected' => false
    ],
    [
        'method' => 'GET',
        'uri' => '/register',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->showRegister();
        },
        'protected' => false
    ],
    [
        'method' => 'POST',
        'uri' => '/register',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->register($request);
        },
        'protected' => false
    ],
    [
        'method' => 'GET',
        'uri' => '/logout',
        'target' => function() {
            (new AuthController())->logout();
        },
        'protected' => true
    ]
];
