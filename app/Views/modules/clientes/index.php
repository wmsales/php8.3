<?php include __DIR__ . "/../../layouts/header.php";

function truncate($text, $length)
{
    return strlen($text) > $length ? substr($text, 0, $length) . "..." : $text;
}
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-6 mb-2">
            <?php include __DIR__ . "/../../components/breadcrumb.php"; ?>
        </div>
        <div class="col-md-2 mb-2">
        </div>
        <div class="col-md-4 mb-2 text-end">
            <!-- Botón para agregar nuevo cliente -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClienteModal">
                <i class="fas fa-plus"></i> Agregar Cliente
            </button>
        </div>
    </div>

    <div class="row m-1 bg-white rounded">
        <div class="col-md-12 p-4">
            <table class="table table-striped table-hover table-bordered" id="clientesTable">
                <thead>
                    <tr class="table-dark">
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>NIT</th>
                        <th class="text-center">Activo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="clientesBody">
                    <?php foreach ($clientes as $cliente): ?>
                        <tr data-id="<?php echo $cliente["id"]; ?>">
                            <td><?php echo truncate(
                                $cliente["nombre"],
                                20
                            ); ?></td>
                            <td><?php echo truncate(
                                $cliente["direccion"],
                                40
                            ); ?>
                            <td><?php echo $cliente["telefono"]; ?></td>
                            <td><?php echo $cliente["nit"]; ?></td>
                            <td class="text-center"><?php echo $cliente[
                                "active"
                            ]
                                ? "✅"
                                : "❌"; ?></td>
                            <td class="text-center">
                                <!-- Botón para editar -->
                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $cliente[
                                    "id"
                                ]; ?>"
                                    data-bs-toggle="modal" data-bs-target="#editClienteModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Botón para eliminar -->
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $cliente[
                                    "id"
                                ]; ?>"
                                    data-bs-toggle="modal" data-bs-target="#deleteClienteModal" <?php echo $cliente[
                                        "active"
                                    ]
                                        ? ""
                                        : "disabled"; ?>>
                                    <i class="fas fa-trash"></i>
                                </button>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $currentPage
                            ? "active"
                            : ""; ?>">
                            <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal para agregar cliente -->
<div class="modal fade" id="addClienteModal" tabindex="-1" aria-labelledby="addClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Modal más ancho -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClienteLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addClienteForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" class="form-control" id="nit">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cui" class="form-label">CUI</label>
                            <input type="text" class="form-control" id="cui">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="active" class="form-label">Activo</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="activoSwitch" checked>
                                <label class="form-check-label" for="activoSwitch">Activo</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar cliente -->
<div class="modal fade" id="editClienteModal" tabindex="-1" aria-labelledby="editClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Modal más ancho -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClienteLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClienteForm">
                    <input type="hidden" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="edit-direccion">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="edit-telefono">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-nit" class="form-label">NIT</label>
                            <input type="text" class="form-control" id="edit-nit">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-cui" class="form-label">CUI</label>
                            <input type="text" class="form-control" id="edit-cui">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="edit-fecha_nacimiento">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-activo" class="form-label">Activo</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit-activoSwitch">
                                <label class="form-check-label" for="edit-activoSwitch">Activo</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        addPaginationListeners();
        addModalListeners();
        resetFormOnModalClose();
    });

    const resetFormOnModalClose = () => {
        const addClienteModal = document.getElementById('addClienteModal');
        addClienteModal.addEventListener('show.bs.modal', () => {
            resetForm('addClienteForm');
        });

        const editClienteModal = document.getElementById('editClienteModal');
        editClienteModal.addEventListener('hide.bs.modal', () => {
            resetForm('editClienteForm');
        });
    }

    const resetForm = (formId) => {
        const form = document.getElementById(formId);
        form.reset(); // Esto limpia todos los inputs del formulario
        if (formId === 'editClienteForm') {
            document.getElementById('edit-activoSwitch').checked = false; // Asegurar que el checkbox también se limpie
        }
    }

    const addPaginationListeners = () => {
        document.querySelectorAll('.page-link').forEach((link) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = link.getAttribute('data-page');

                fetch(`/clientes?page=${page}`)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        document.getElementById('clientesBody').innerHTML = doc.querySelector('#clientesBody').innerHTML;
                        document.getElementById('pagination').innerHTML = doc.querySelector('#pagination').innerHTML;

                        addPaginationListeners();
                        addModalListeners(); // Re-inicializar modales para los nuevos elementos
                    })
                    .catch(error => {
                        console.error('Error al cambiar de página:', error);
                    });
            });
        });
    }

    // Crear cliente
    document.getElementById('addClienteForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const nombre = document.getElementById('nombre').value;
        const direccion = document.getElementById('direccion').value;
        const telefono = document.getElementById('telefono').value;
        const email = document.getElementById('email').value;
        const nit = document.getElementById('nit').value;
        const cui = document.getElementById('cui').value;
        const fecha_nacimiento = document.getElementById('fecha_nacimiento').value;
        const active = document.getElementById('activoSwitch').checked ? 1 : 0;

        fetch('/cliente/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre, direccion, telefono, email, nit, cui, fecha_nacimiento, active })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente agregado',
                        text: 'El cliente fue agregado exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error al agregar cliente:', error);
                Swal.fire('Error', 'Ocurrió un error al intentar agregar el cliente.', 'error');
            });
    });

    // Función para volver a inicializar los modales
    const addModalListeners = () => {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');  // Obtener el ID del cliente

                fetch(`/cliente/get/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Llenar el formulario de edición con los datos recibidos
                            document.getElementById('edit-id').value = data.cliente.id;
                            document.getElementById('edit-nombre').value = data.cliente.nombre;
                            document.getElementById('edit-direccion').value = data.cliente.direccion;
                            document.getElementById('edit-telefono').value = data.cliente.telefono;
                            document.getElementById('edit-email').value = data.cliente.email;
                            document.getElementById('edit-nit').value = data.cliente.nit;
                            document.getElementById('edit-cui').value = data.cliente.cui;
                            document.getElementById('edit-fecha_nacimiento').value = data.cliente.fecha_nacimiento;
                            document.getElementById('edit-activoSwitch').checked = data.cliente.active == 1;
                        } else {
                            Swal.fire('Error', 'No se pudo obtener los datos del cliente', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del cliente:', error);
                        Swal.fire('Error', 'Ocurrió un error al obtener los datos del cliente.', 'error');
                    });
            });
        });

        // Editar cliente (enviar cambios al servidor)
        document.getElementById('editClienteForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('edit-id').value;
            const nombre = document.getElementById('edit-nombre').value;
            const direccion = document.getElementById('edit-direccion').value;
            const telefono = document.getElementById('edit-telefono').value;
            const email = document.getElementById('edit-email').value;
            const nit = document.getElementById('edit-nit').value;
            const cui = document.getElementById('edit-cui').value;
            const fecha_nacimiento = document.getElementById('edit-fecha_nacimiento').value;
            const active = document.getElementById('edit-activoSwitch').checked ? 1 : 0;

            fetch('/cliente/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, nombre, direccion, telefono, email, nit, cui, fecha_nacimiento, active })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cliente actualizado',
                            text: 'El cliente fue actualizado exitosamente.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            setTimeout(() => {
                                location.reload();
                            }, 600);
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error al actualizar cliente:', error);
                    Swal.fire('Error', 'Ocurrió un error al intentar actualizar el cliente.', 'error');
                });
        });

        // Eliminar cliente
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');  // Obtener el ID del cliente a eliminar

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'No podrás revertir esta acción',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/cliente/delete', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id })  // Enviar el ID del cliente en la solicitud
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Cliente eliminado',
                                        text: 'El cliente fue eliminado exitosamente.',
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error al eliminar cliente:', error);
                                Swal.fire('Error', 'Ocurrió un error al intentar eliminar el cliente.', 'error');
                            });
                    }
                });
            });
        });
    }
</script>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
