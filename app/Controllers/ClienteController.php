<?php

namespace App\Controllers;

use App\Core\Database;
use App\Repositories\ClienteRepository;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $database = new Database();
        $clienteRepository = new ClienteRepository($database);
        parent::__construct($clienteRepository);
    }

    public function listClientes()
    {
        $clientes = $this->repository->getAll();
        return $this->render('clientes/list', ['clientes' => $clientes]);
    }
}
