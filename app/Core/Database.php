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
            $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
            $dotenv->load();

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
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Error configuracion base de datos: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
