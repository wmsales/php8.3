<?php
$modulos = include __DIR__ . '/../../Config/Modulos.php';
$uriActual = $_SERVER['REQUEST_URI'];

$moduloActual = null;

foreach ($modulos as $moduloPadre) {
    if (!empty($moduloPadre['hijos'])) {
        foreach ($moduloPadre['hijos'] as $moduloHijo) {
            if ($moduloHijo['ruta'] === $uriActual) {
                // Asignar el módulo actual
                $moduloActual = [
                    'nombre' => $moduloHijo['nombre'],
                    'icono' => $moduloHijo['icono']
                ];
                break 2;
            }
        }
    }
}
?>

<?php if ($moduloActual): ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <i class="<?= $moduloActual['icono'] ?>"></i> <?= $moduloActual['nombre'] ?>
        </li>
    </ol>
</nav>
<?php endif; ?>
