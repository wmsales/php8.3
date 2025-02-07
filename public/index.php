<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new AltoRouter();
$routes = include __DIR__ . '/../app/Config/Routes.php';

foreach ($routes as $route) {
    $router->map($route['method'], $route['uri'], $route['target']);
}

$match = $router->match();

if ($match) {
    try {
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            if (isset($match['target']) && is_array($match['target'])) {
                list($controller, $method) = $match['target'];
                $controller = new $controller();
                call_user_func_array([$controller, $method], $match['params']);
            } else {
                (new \App\Controllers\ErrorController())->notFound();
            }
        }
    } catch (Exception $e) {
        (new \App\Controllers\ErrorController())->internalServerError();
    }
} else {
    (new \App\Controllers\ErrorController())->notFound();
}
