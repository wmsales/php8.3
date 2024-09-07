<?php

namespace App\Controllers;

/**
 * 
 * Este controlador se utiliza cuando quieres mostrar una vista estatica, aqui no hay
 * conexion alguna con la base de datos, no tenemos acceso, solo a mostrar vistas php
 * usando la function render, podes expandirlo pero siempre tomando en cuenta la razon
 * de porque esta clase fue creada
 * 
 * Author: David Vargas
 * Last Modified: 7/09/2024 11:56 AM
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
