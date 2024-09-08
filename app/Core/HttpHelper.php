<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HttpHelper
{
    /**
     * Obtiene una solicitud desde las variables globales ($_GET, $_POST, etc.)
     *
     * @return Request
     */
    public static function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    /**
     * Crea una respuesta HTML estándar.
     *
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public static function createResponse(string $content, int $statusCode = 200, array $headers = []): Response
    {
        return new Response($content, $statusCode, $headers);
    }

    /**
     * Crea una respuesta JSON.
     *
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public static function createJsonResponse(array $data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $statusCode, $headers);
    }

    /**
     * Redirige a una URL específica.
     *
     * @param string $url
     * @param int $statusCode
     * @return RedirectResponse
     */
    public static function redirect(string $url, int $statusCode = 302): RedirectResponse
    {
        return new RedirectResponse($url, $statusCode);
    }

    /**
     * Extrae un parámetro de la solicitud (GET, POST, etc.) con saneamiento.
     *
     * @param Request $request
     * @param string $key
     * @param string|null $default
     * @param string $filter
     * @return mixed
     */
    public static function getParam(Request $request, string $key, $default = null, string $filter = FILTER_SANITIZE_STRING)
    {
        return filter_var($request->get($key, $default), $filter);
    }

    /**
     * Obtiene la IP del cliente de manera segura.
     *
     * @param Request $request
     * @return string|null
     */
    public static function getClientIp(Request $request): ?string
    {
        return $request->getClientIp();
    }

}
