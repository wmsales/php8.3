<?php

require __DIR__ . '/../vendor/autoload.php'; // Cargar el autoload de Composer

use App\Core\Database;

try {
    // Intentar la conexión a la base de datos
    $db = new Database();
    $connection = $db->getConnection();

    // Verificar si la conexión es exitosa
    if (!$connection) {
        throw new Exception('No se pudo establecer la conexión con la base de datos.');
    }

    // Intentar hacer un SELECT a la tabla 'rol'
    $roles = $connection->select("rol", "*");

    if (empty($roles)) {
        echo "No hay roles en la tabla.";
    } else {
        echo "Roles en la base de datos:<br>";
        foreach ($roles as $rol) {
            echo "ID: " . $rol['id'] . " - Nombre: " . $rol['nombre'] . "<br>";
        }
    }

} catch (PDOException $e) {
    // Si hay un error relacionado con la base de datos
    echo "Error de base de datos: " . $e->getMessage();
} catch (Exception $e) {
    // Otros errores generales
    echo "Error: " . $e->getMessage();
} finally {
    // En el bloque finally, puedes liberar recursos o hacer registros
    echo "<br>Proceso finalizado.";
}
