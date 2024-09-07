<?php

namespace App\Controllers;

use App\Core\Database;
use App\Repositories\UsuarioRepository;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController
{
    protected $usuarioRepository;

    public function __construct()
    {
        $database = new Database();
        $this->usuarioRepository = new UsuarioRepository($database);
    }

    public function showLogin()
    {
        $this->render('auth/login');
    }

    public function login(Request $request)
    {
        $email = filter_var($request->request->get('email'), FILTER_SANITIZE_EMAIL);
        $password = $request->request->get('password');

        $usuario = $this->usuarioRepository->findBy('email', $email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['user_id'] = $usuario['id'];
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
        $nombre = filter_var($request->request->get('nombre'), FILTER_SANITIZE_STRING);
        $email = filter_var($request->request->get('email'), FILTER_SANITIZE_EMAIL);
        $password = password_hash($request->request->get('password'), PASSWORD_DEFAULT);

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
        session_destroy();
        header('Location: /login');
    }
}
