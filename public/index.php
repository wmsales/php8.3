<?php

require '../vendor/autoload.php';

$router = new AltoRouter();
$routes = include __DIR__ . '/../app/Config/Routes.php';

foreach ($routes as $route) {
    $router->map($route['method'], $route['uri'], $route['target']);
}

$match = $router->match();
if ($match) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        list($controller, $method) = $match['target'];
        $controller = new $controller();
        call_user_func_array([$controller, $method], $match['params']);
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo '404 Not Found';
}