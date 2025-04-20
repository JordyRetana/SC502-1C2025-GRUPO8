<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();
$resultado = $conn->query("SELECT * FROM usuarios_pendientes ORDER BY fecha_registro DESC");
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<div class="main-content">
    <h2 class="mb-4 text-white">🕒 Usuarios Pendientes</h2>
    <p class="text-white">Solicitudes de registro pendientes en el sistema.</p>

    <div class="table-responsive bg-dark text-white p-3 rounded shadow">
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de registro</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['id'] ?></td>
                        <td><?= htmlspecialchars($fila['first_name'] . ' ' . $fila['last_name']) ?></td>
                        <td><?= htmlspecialchars($fila['email']) ?></td>
                        <td><?= $fila['fecha_registro'] ?></td>
                        <td><span class="badge bg-warning text-dark"><?= ucfirst($fila['estado']) ?></span></td>
                        <td>
                            <?php if ($fila['estado'] != 'revisar'): ?>
                                <form method="POST" action="/FINAL/dashboard/api/usuarios/revisar.php">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-info">Marcar como Revisar</button>
                                </form>
                            <?php else: ?>
                                <span class="text-success">✓ Revisado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/footer.php'; ?>
