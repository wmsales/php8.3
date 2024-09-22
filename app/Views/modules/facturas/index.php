<?php include __DIR__ . "/../../layouts/header.php"; ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8">
            <h1><?php echo $titulo; ?></h1>
        </div>
        <div class="col-md-4 text-end">
            <?php foreach ($botones as $boton): ?>
                <a href="<?php echo $boton["url"]; ?>" class="btn btn-primary">
                    <i class="<?php echo $boton[
                        "icono"
                    ]; ?>"></i> <?php echo $boton["nombre"]; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row m-1 p-4 bg-white rounded">
        <div class="col-md-12">
            <?php echo $html; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
