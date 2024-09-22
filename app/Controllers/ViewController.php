<?php

namespace App\Controllers;

/**
 *
 * Este controlador se utiliza cuando quieres mostrar una vista en la aplicación.
 * Se encarga de renderizar la vista y pasarle los datos necesarios. Fue creada para
 * vistas que solo muestran información y no requieren de lógica del repositorio. Pero
 * puedes usar logica de PHP para precargar datos en la vista.
 *
 * Author: David Vargas
 * Last Modified: 22/09/2024 13:30
 *
 */

class ViewController
{
    protected function render($view, $data = [])
    {
        extract($data);

        $viewPath = realpath(__DIR__ . "/../Views/{$view}.php");

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Error: La vista '{$view}' no se encontró en {$viewPath}.";
        }
    }
}
