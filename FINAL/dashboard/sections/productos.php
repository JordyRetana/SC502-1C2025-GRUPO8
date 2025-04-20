<?php
$cssFile = "../assets/css/styles_product.css";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Plataforma/pages/auth/login.php');
    exit;
}
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();

$sql = "SELECT * FROM productos ORDER BY categoria ASC";
$result = mysqli_query($conn, $sql);
$productos = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
mysqli_close($conn);

require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<main class="main-content">
    <div class="dashboard-content">
        <div class="dashboard-header">
            <h1 class="title">🛒 Productos</h1>
            <p class="subtitle">Consulta y gestiona los productos disponibles en el sistema.</p>

            <div class="stats">
                <div class="stat-card total">Total productos: <?php echo count($productos); ?></div>
                <div class="stat-card read">Con stock: <?php echo count(array_filter($productos, fn($p) => $p['stock'] > 0)); ?></div>
                <div class="stat-card unread">Sin stock: <?php echo count(array_filter($productos, fn($p) => $p['stock'] <= 0)); ?></div>
            </div>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['id']); ?></td>
                            <td><?= htmlspecialchars($producto['nombre']); ?></td>
                            <td><?= htmlspecialchars($producto['descripcion']); ?></td>
                            <td>$<?= number_format($producto['precio'], 2); ?></td>
                            <td><img src="<?= htmlspecialchars($producto['imagen_url']); ?>" alt="Imagen" style="max-width: 50px;"></td>
                            <td><?= htmlspecialchars($producto['categoria']); ?></td>
                            <td><?= $producto['stock']; ?></td>
                            <td><?= $producto['fecha_creacion']; ?></td>
                            <td><?= $producto['fecha_actualizacion']; ?></td>
                            <td>
                                <a href="#" class="editar-btn" data-producto='<?= json_encode($producto); ?>'>Editar</a> |
                                <a href="/FINAL/dashboard/api/productos/eliminar.php?id=<?= $producto['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="10">No hay productos disponibles.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Producto</h2>
        <form id="editForm" method="POST" action="/FINAL/dashboard/api/productos/editar.php">
            <input type="hidden" name="id" id="editId">
            <label>Nombre: <input type="text" name="nombre" id="editNombre"></label><br>
            <label>Descripción: <textarea name="descripcion" id="editDescripcion"></textarea></label><br>
            <label>Precio: <input type="number" step="0.01" name="precio" id="editPrecio"></label><br>
            <label>Categoría: <input type="text" name="categoria" id="editCategoria"></label><br>
            <label>Stock: <input type="number" name="stock" id="editStock"></label><br>
            <button type="submit">Guardar Cambios</button>
        </form>
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
    background-color: #1e1e1e;
    color: #fff;
    margin: auto;
    padding: 20px;
    border: 2px solid #444;
    width: 40%;
    border-radius: 10px;
}

.modal-content input,
.modal-content textarea {
    width: 100%;
    padding: 6px;
    margin: 6px 0 12px;
    border: 1px solid #555;
    background: #2c2c2c;
    color: #fff;
}

.modal-content button {
    background-color: #00b894;
    color: white;
    border: none;
    padding: 8px 14px;
    cursor: pointer;
    border-radius: 6px;
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
</style>

<script>
document.querySelectorAll('.editar-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const producto = JSON.parse(this.dataset.producto);

        document.getElementById('editId').value = producto.id;
        document.getElementById('editNombre').value = producto.nombre;
        document.getElementById('editDescripcion').value = producto.descripcion;
        document.getElementById('editPrecio').value = producto.precio;
        document.getElementById('editCategoria').value = producto.categoria;
        document.getElementById('editStock').value = producto.stock;

        document.getElementById('editModal').style.display = 'block';
    });
});

document.querySelector('.modal .close').addEventListener('click', () => {
    document.getElementById('editModal').style.display = 'none';
});

window.addEventListener('click', function(e) {
    if (e.target === document.getElementById('editModal')) {
        document.getElementById('editModal').style.display = 'none';
    }
});
</script>

<?php require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/footer.php'; ?>
