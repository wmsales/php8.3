<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\HttpHelper;

use App\Repositories\UsuarioRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController
{
    protected $usuarioRepository;
    private $jwtSecret;

    public function __construct()
    {
        $database = new Database();
        $this->usuarioRepository = new UsuarioRepository($database);
        $this->jwtSecret = $_ENV['JWT_SECRET'];
    }

    public function showLogin()
    {
        $this->render('auth/login');
    }

    public function login(Request $request)
    {
        $email = HttpHelper::getParam($request, 'email', null, FILTER_SANITIZE_EMAIL);
        $password = HttpHelper::getParam($request, 'password');

        $usuario = $this->usuarioRepository->findBy('email', $email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $rolRepository = new \App\Repositories\RolRepository(new Database());
            $rol = $rolRepository->findById($usuario['rol_id']);
            
            if (!$rol) {
                $this->render('auth/login', ['error' => 'Rol no encontrado']);
                return;
            }

            $payload = [
                'user_id' => $usuario['id'],
                'email' => $usuario['email'],
                'rol' => $rol['nombre'],
                'exp' => time() + (60 * 60) // Expires 1 hour
            ];

            $jwt = JWT::encode($payload, $this->jwtSecret, 'HS256');

            setcookie('jwt', $jwt, time() + (60 * 60), "/", "", false, true);

            header('Location: /home');
        } else {
            $this->render('auth/login', ['error' => 'Credenciales incorrectas']);
        }
    }

    public function showRegister()
    {
        $this->render('auth/register');
    }

    public function register(Request $request)
    {
        $nombre = HttpHelper::getParam($request, 'nombre');
        $email = HttpHelper::getParam($request, 'email', null, FILTER_SANITIZE_EMAIL);
        $password = password_hash(HttpHelper::getParam($request, 'password'), PASSWORD_DEFAULT);

        $usuarioData = [
            'nombre' => $nombre,
            'email' => $email,
            'password' => $password,
            'rol_id' => 5, // Rol INVITADO por defecto
            'active' => 1
        ];

        $this->usuarioRepository->insert($usuarioData);
        header('Location: /login');
    }

    public function logout()
    {
        setcookie('jwt', '', time() - 3600, "/"); // Eliminar la cookie JWT
        header('Location: /login');
    }
}
