<?php

namespace App\Controllers;

use App\Core\Database;
use App\Repositories\BaseRepository;

class BaseController
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    // Obtener todos los registros
    public function index()
    {
        return $this->repository->getAll();
    }

    // Crear un nuevo registro
    public function create(array $data)
    {
        return $this->repository->insert($data);
    }

    // Actualizar un registro
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    // Eliminar un registro
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    protected function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../../Views/{$view}.php";
    }
}
