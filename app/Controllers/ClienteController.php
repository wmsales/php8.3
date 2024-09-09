<?php

namespace App\Controllers;

use App\Core\HttpHelper;
use App\Repositories\ClienteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $clientes = $this->repository->getAll();
        $this->render('modules/clientes/index', ['clientes' => $clientes]);
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

        if (!$nombre || !$email) {
            return HttpHelper::createJsonResponse(
                ['status' => 'error', 'message' => 'Nombre y Email son obligatorios'],
                400
            );
        }

        $data = [
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email
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
        $request = HttpHelper::getRequest();

        $id = HttpHelper::getParam($request, 'id');
        $nombre = HttpHelper::getParam($request, 'nombre');
        $direccion = HttpHelper::getParam($request, 'direccion');
        $telefono = HttpHelper::getParam($request, 'telefono');
        $email = HttpHelper::getParam($request, 'email');

        if (!$id || !$nombre || !$email) {
            return HttpHelper::createJsonResponse(
                ['status' => 'error', 'message' => 'ID, Nombre y Email son obligatorios'],
                400
            );
        }

        $data = [
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email
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

        $result = $this->repository->delete($id);

        if ($result) {
            return HttpHelper::createJsonResponse(['status' => 'success', 'message' => 'Cliente eliminado']);
        }

        return HttpHelper::createJsonResponse(['status' => 'error', 'message' => 'Error al eliminar cliente'], 500);
    }
}
