<?php
$cssFile = "../assets/css/styles_sus.css";
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();
$resultado = $conn->query("SELECT * FROM usuarios ORDER BY created_at DESC");
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<div class="main-content">
<h2 class="mb-2" style="color: white;">👥 Usuarios</h2>
<p style="color: #ddd;">Lista de usuarios registrados en el sistema.</p>


    <div class="table-responsive bg-dark text-white p-3 rounded shadow">
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['id'] ?></td>
                        <td><?= htmlspecialchars($fila['name']) ?></td>
                        <td><?= htmlspecialchars($fila['email']) ?></td>
                        <td><?= htmlspecialchars($fila['password']) ?></td>
                        <td><?= $fila['created_at'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal<?= $fila['id'] ?>">Editar</button>
                            <button class="btn btn-sm btn-info" onclick="copyToClipboard('<?= $fila['email'] ?>')">Copiar</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?= $fila['id'] ?>)">Borrar</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editarModal<?= $fila['id'] ?>" tabindex="-1" aria-labelledby="editarModalLabel<?= $fila['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-dark">
                                <form method="POST" action="/FINAL/dashboard/api/usuarios/editar_usuario.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarModalLabel<?= $fila['id'] ?>">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                        <div class="mb-2">
                                            <label>Nombre</label>
                                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($fila['name']) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Correo</label>
                                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($fila['email']) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Contraseña </label>
                                            <input type="password" name="password" class="form-control" placeholder="••••••••">
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

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert("Correo copiado al portapapeles");
        }).catch(function(err) {
            alert("Error al copiar el correo: " + err);
        });
    }

    function deleteUser(userId) {
        if (confirm("¿Estás seguro de que deseas borrar este usuario?")) {
            window.location.href = `/FINAL/dashboard/api/usuarios/borrar_usuario.php?id=${userId}`;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/footer.php';
?>
