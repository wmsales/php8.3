<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="text-center m-5">
        <h2>Clientes</h2>

        <textarea name="" id="" cols="60" rows="10">
            <?php echo json_encode($clientes, JSON_PRETTY_PRINT); ?>
        </textarea>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
