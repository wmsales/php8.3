<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Request;

return [
    [
        'method' => 'GET',
        'uri' => '/home',
        'target' => [HomeController::class, 'showHome']
    ],
    [
        'method' => 'GET',
        'uri' => '/login',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->showLogin();
        }
    ],
    [
        'method' => 'POST',
        'uri' => '/login',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->login($request);
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/register',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->showRegister();
        }
    ],
    [
        'method' => 'POST',
        'uri' => '/register',
        'target' => function() {
            $request = Request::createFromGlobals();
            (new AuthController())->register($request);
        }
    ],
    [
        'method' => 'GET',
        'uri' => '/logout',
        'target' => function() {
            (new AuthController())->logout();
        }
    ]
];
