<?php

namespace App\Core;

use Medoo\Medoo;
use Dotenv\Dotenv;
use PDO;
use PDOException;
use Exception;

class Database
{
    protected $connection;

    public function __construct()
    {
        try {
            // Cargar las variables de entorno del archivo .env
            $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
            $dotenv->load();

            // Configuración de la base de datos utilizando Medoo
            $this->connection = new Medoo([
                'type' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'charset' => $_ENV['DB_CHARSET'],
                'error' => PDO::ERRMODE_EXCEPTION,
                'timeout' => 15,
            ]);
        } catch (PDOException $e) {
            // Si ocurre un error relacionado con la base de datos, lanzar excepción
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        } catch (Exception $e) {
            // Si ocurre algún otro tipo de error
            throw new Exception("Error al configurar la base de datos: " . $e->getMessage());
        }
    }

    // Método para obtener la conexión
    public function getConnection()
    {
        return $this->connection;
    }
}
