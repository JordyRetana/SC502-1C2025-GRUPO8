<?php
$cssFile = "../assets/css/styles_ventas.css";
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();

$sql = "SELECT v.*, p.nombre AS producto_nombre 
        FROM ventas v
        LEFT JOIN productos p ON v.producto_id = p.id
        ORDER BY v.fecha DESC";
$resultado = $conn->query($sql);

require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<div class="main-content">
<h2 class="mb-2" style="color: white;">🧾 Ventas</h2>
<p style="color: #ddd;">Historial de ventas registradas en el sistema.</p>


    <div class="table-responsive bg-dark text-white p-3 rounded shadow">
        <table class="table table-dark table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $fila['id'] ?></td>
                        <td><?= htmlspecialchars($fila['producto_nombre'] ?? 'Desconocido') ?></td>
                        <td><?= $fila['cantidad'] ?></td>
                        <td>$<?= number_format($fila['precio_unitario'], 2) ?></td>
                        <td>$<?= number_format($fila['cantidad'] * $fila['precio_unitario'], 2) ?></td>
                        <td><?= $fila['fecha'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/footer.php';
?>
