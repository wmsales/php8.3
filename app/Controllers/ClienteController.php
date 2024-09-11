<?php

namespace App\Controllers;

use App\Core\HttpHelper;
use App\Repositories\ClienteRepository;

class ClienteController extends BaseController
{
    public function __construct()
    {
        $clienteRepository = new ClienteRepository(new \App\Core\Database());
        parent::__construct($clienteRepository);
    }

    /**
     * Muestra la lista de clientes
     */
    public function showIndex()
    {
        $request = HttpHelper::getRequest();
        $page = HttpHelper::getParam($request, 'page', 1); // Por defecto, página 1
    
        $perPage = 7; // Número de clientes por página
        $totalClientes = $this->repository->countAll();
        $clientes = $this->repository->getPaginated($page, $perPage);
    
        $totalPages = ceil($totalClientes / $perPage);
    
        $this->render('modules/clientes/index', [
            'clientes' => $clientes,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * Obtener datos de un cliente por ID
     */
    public function getCliente($id)
    {
        $cliente = $this->repository->findById($id);

        if ($cliente) {
            return HttpHelper::createJsonResponse([
                'status' => 'success',
                'cliente' => $cliente
            ]);
        }

        return HttpHelper::createJsonResponse([
            'status' => 'error',
            'message' => 'Cliente no encontrado'
        ], 404);
    }

    /**
     * Crea un nuevo cliente
     */
    public function createCliente()
    {
        $request = HttpHelper::getRequest();

        $nombre = HttpHelper::getParam($request, 'nombre');
        $direccion = HttpHelper::getParam($request, 'direccion');
        $telefono = HttpHelper::getParam($request, 'telefono');
        $email = HttpHelper::getParam($request, 'email');
        $nit = HttpHelper::getParam($request, 'nit');
        $cui = HttpHelper::getParam($request, 'cui') ?: null;
        $fecha_nacimiento = HttpHelper::getParam($request, 'fecha_nacimiento');

        if (!$nombre || !$nit) {
            return HttpHelper::createJsonResponse(
                ['status' => 'error', 'message' => 'Nombre y NIT son obligatorios'],
                400
            );
        }

        $data = [
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
            'nit' => $nit,
            'cui' => $cui,
            'fecha_nacimiento' => $fecha_nacimiento
        ];

        $result = $this->repository->insert($data);

        if ($result) {
            return HttpHelper::createJsonResponse(['status' => 'success', 'message' => 'Cliente agregado exitosamente']);
        }

        return HttpHelper::createJsonResponse(['status' => 'error', 'message' => 'Error al agregar cliente'], 500);
    }

    /**
     * Actualiza un cliente existente
     */
    public function updateCliente()
    {
        $requestBody = file_get_contents('php://input');
        $requestData = json_decode($requestBody, true);

        $id = $requestData['id'] ?? null;
        $nombre = $requestData['nombre'] ?? null;
        $direccion = $requestData['direccion'] ?? null;
        $telefono = $requestData['telefono'] ?? null;
        $email = $requestData['email'] ?? null;
        $nit = $requestData['nit'] ?? null;
        $cui = $requestData['cui'] ?? null;
        $fecha_nacimiento = $requestData['fecha_nacimiento'] ?? null;
        $active = $requestData['active'] ?? 0;

        if (!$id || !$nombre || !$nit) {
            return HttpHelper::createJsonResponse(
                ['status' => 'error', 'message' => 'ID, Nombre y NIT son obligatorios'],
                400
            );
        }

        $data = [
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
            'nit' => $nit,
            'cui' => $cui,
            'fecha_nacimiento' => $fecha_nacimiento,
            'active' => $active
        ];

        $result = $this->repository->update($id, $data);

        if ($result) {
            return HttpHelper::createJsonResponse(['status' => 'success', 'message' => 'Cliente actualizado exitosamente']);
        }

        return HttpHelper::createJsonResponse(['status' => 'error', 'message' => 'Error al actualizar cliente'], 500);
    }


    /**
     * Elimina un cliente
     */
    public function deleteCliente()
    {
        $request = HttpHelper::getRequest();
        $id = HttpHelper::getParam($request, 'id');

        if (!$id) {
            return HttpHelper::createJsonResponse(
                ['status' => 'error', 'message' => 'El ID es obligatorio'],
                400
            );
        }

        $result = $this->repository->deleteActive($id);

        if ($result) {
            return HttpHelper::createJsonResponse(['status' => 'success', 'message' => 'Cliente eliminado']);
        }

        return HttpHelper::createJsonResponse(['status' => 'error', 'message' => 'Error al eliminar cliente'], 500);
    }
}
