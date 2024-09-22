<?php include __DIR__ . "/../../layouts/header.php"; ?>


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-6 mb-2">
            <?php include __DIR__ . "/../../components/breadcrumb.php"; ?>
        </div>
        <div class="col-md-6 mb-2 text-end">
            <div class="btn-group" role="group">
                <button class="btn btn-success" id="buscarArticulo">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <button class="btn btn-secondary" id="limpiarFormulario">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
                <button class="btn btn-primary" id="guardarArticulo">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <button class="btn btn-danger" id="eliminarArticulo" disabled>
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </div>
        </div>

    </div>

    <div class="p-4 bg-white rounded">
            <!-- Articulos -->
            <div class="card border-primary">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-database m-1"></i> <strong><?php echo $titulo; ?></strong></h3>
                    <span class="fw-bold fs-4" id="codigoProducto"></span>
                </div>
                <div class="card-body">
                    <h3 class="text-center fw-bold text-danger">Datos Obligatorios</h3>
                    <hr>
                    <div class="row mt-1" id="formArticulo">
                        <div class="row" id="importantData">
                            <div class="col-md-6">
                                <div class="row mt-2 mb-1">
                                    <div class="col-md-4">
                                        <label for="codigoant" class="form-label required fw-bold mt-2">Código Producto</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="codigoant" placeholder="Código">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label required fw-bold asterisk">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="nombre_corto" class="form-label required fw-bold asterisk">Nombre Corto</label>
                                    <input type="text" class="form-control" id="nombre_corto" maxlength="60" placeholder="Nombre Corto (Max. 65 caracteres)">
                                    <span class="mt-1 badge bg-success" id="contador">0/60</span>
                                </div>
                                <div class="mb-3">
                                    <label for="unidad_medida" class="form-label fw-bold required">Unidad de Medida</label>
                                    <select class="form-select" id="unidad_medida"><option value="">Seleccione una medida</option><option value="1">Unidad</option></select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="marca" class="form-label fw-bold required">Marca</label>
                                    <select class="form-select" id="marca"><option value="">Seleccione la marca</option></select>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label fw-bold required">Categoría</label>
                                    <select class="form-select" id="categoria"><option value="">Seleccione una categoría</option><option value="1">Ferreteria</option></select>
                                </div>
                                <div class="mb-3">
                                    <label for="scategoria" class="form-label fw-bold required">Subcategoría</label>
                                    <select class="form-select" id="scategoria">
                                        <option value="">Seleccione una subcategoría</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label fw-bold required">Estado</label>
                                    <select class="form-select" id="estado">
                                        <option value="1" selected="">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center fw-bold text-success mb-3">Datos Opcionales</h4>
                        <hr>
                        <div class="row" id="secondaryData">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                    <textarea class="form-control" id="descripcion" placeholder="Descripción" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="observaciones" class="form-label fw-bold">Observaciones</label>
                                    <textarea class="form-control" id="observaciones" rows="3" placeholder="Observaciones"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ubicacion" class="form-label fw-bold">Ubicación Bodega</label>
                                    <input type="text" class="form-control" id="ubicacion" placeholder="Ubicación Bodega">
                                </div>
                                <div class="mb-3">
                                    <label for="peso" class="form-label fw-bold required">Peso</label>
                                    <input type="text" class="form-control" id="peso" placeholder="Peso en gramos">
                                </div>
                                <div class="mb-3">
                                    <label for="detalle" class="form-label fw-bold">Detalle</label>
                                    <input type="text" class="form-control" id="detalle" placeholder="Detalle">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
