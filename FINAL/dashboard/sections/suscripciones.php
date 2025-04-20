<?php
$cssFile = "../assets/css/styles_sus.css";
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();
$resultado = $conn->query("SELECT * FROM suscripciones ORDER BY fecha_suscripcion DESC");
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<div class="main-content">
    <h2 class="mb-4">🧾 Suscripciones</h2>
    <p>Lista de usuarios que se han suscrito a los planes del sistema.</p>

    <div class="table-responsive bg-dark text-white p-3 rounded shadow">
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Plan</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['id'] ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['correo']) ?></td>
                        <td><?= htmlspecialchars($fila['telefono']) ?></td>
                        <td><span class="badge bg-info text-dark"><?= $fila['plan'] ?></span></td>
                        <td><?= $fila['fecha_suscripcion'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editarModal<?= $fila['id'] ?>">Editar</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editarModal<?= $fila['id'] ?>" tabindex="-1" aria-labelledby="editarModalLabel<?= $fila['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-dark">
                                <form method="POST" action="/FINAL/dashboard/api/suscripciones/editar_suscripcion.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarModalLabel<?= $fila['id'] ?>">Editar Suscripción</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                        <div class="mb-2">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($fila['nombre']) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Correo</label>
                                            <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($fila['correo']) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($fila['telefono']) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Plan</label>
                                            <select name="plan" class="form-select">
                                                <option <?= $fila['plan'] == 'Demo' ? 'selected' : '' ?>>Demo</option>
                                                <option <?= $fila['plan'] == 'Basic' ? 'selected' : '' ?>>Basic</option>
                                                <option <?= $fila['plan'] == 'Pro' ? 'selected' : '' ?>>Pro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 80px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(15, 15, 15, 0.9);
}

.modal-content {
    background-color: #2c3e50;
    color: #fff;
    margin: auto;
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #34495e;
    width: 50%;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease-in-out;
}

.modal-content input,
.modal-content textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0 16px;
    border: 1px solid #555;
    background: #34495e;
    color: #fff;
    border-radius: 6px;
}

.modal-content button {
    background-color: #00b894;
    color: white;
    border: none;
    padding: 10px 18px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.modal-content button:hover {
    background-color: #019875;
}

.close {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.modal-dialog-centered {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-header {
    border-bottom: 2px solid #34495e;
    background-color: #1a252f;
    color: #fff;
    padding: 15px 20px;
    border-radius: 8px 8px 0 0;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalElements = document.querySelectorAll('.modal');

        modalElements.forEach(function (modalElement) {
            modalElement.addEventListener('shown.bs.modal', function () {
                var modalForm = modalElement.querySelector('form');
                
                if (modalForm) {
                    modalForm.reset();
                }

                if (modalElement) {
                    console.log('Modal abierto: ', modalElement);
                } else {
                    console.log('Modal no encontrado');
                }
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                console.log('Modal cerrado');
            });
        });
    });
</script>

<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/footer.php';
?>
