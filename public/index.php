<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ClienteController;

$clienteController = new ClienteController();

$cliente = $clienteController->index();

print_r($cliente);