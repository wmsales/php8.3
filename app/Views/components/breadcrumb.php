<?php
$modulos = include __DIR__ . '/../../Config/Modulos.php';
$uriActual = $_SERVER['REQUEST_URI'];

$breadcrumbItems = [['nombre' => 'Inicio', 'ruta' => '/home', 'icono' => 'fas fa-home']];

if ($uriActual !== '/home') {
    foreach ($modulos as $moduloPadre) {
        if (!empty($moduloPadre['hijos'])) {
            foreach ($moduloPadre['hijos'] as $moduloHijo) {
                if ($moduloHijo['ruta'] === $uriActual) {
                    $breadcrumbItems[] = [
                        'nombre' => $moduloPadre['nombre'],
                        'ruta' => '#',
                        'icono' => $moduloPadre['icono']
                    ];
                    $breadcrumbItems[] = [
                        'nombre' => $moduloHijo['nombre'],
                        'ruta' => $moduloHijo['ruta'],
                        'icono' => $moduloHijo['icono']
                    ];
                    break 2;
                }
            }
        }
    }
}
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($breadcrumbItems as $item): ?>
            <?php if ($item === end($breadcrumbItems)): ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="<?= $item['icono'] ?>"></i> <?= $item['nombre'] ?>
                </li>
            <?php else: ?>
                <li class="breadcrumb-item">
                    <a href="<?= $item['ruta'] ?>"><i class="<?= $item['icono'] ?>"></i> <?= $item['nombre'] ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
