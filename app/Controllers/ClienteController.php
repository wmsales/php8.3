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

    public function showIndex()
    {
        $clientes = $this->repository->getAll();

        $this->render('modules/clientes/index', ['clientes'=> $clientes]);
    }
}
