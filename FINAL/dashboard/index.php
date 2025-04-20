<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Plataforma/pages/auth/login.php');
    exit;
}

require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';

$conn = getDBConnection();

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT id, nombre, correo, mensaje, fecha, leido FROM mensajes_contacto ORDER BY fecha DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    $messages = [];
}

mysqli_close($conn);

require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/header.php';
require_once 'C:/xampp/htdocs/FINAL/dashboard/includes/sidebar.php';
?>

<main class="main-content">
    <div class="dashboard-content">
        <h1>Mensajes de Contacto</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                    <th>Leído</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($message['id']); ?></td>
                            <td><?php echo htmlspecialchars($message['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($message['correo']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($message['mensaje'])); ?></td>
                            <td><?php echo htmlspecialchars($message['fecha']); ?></td>
                            <td><?php echo $message['leido'] == 1 ? 'Sí' : 'No'; ?></td>
                            <td>
                                <a href="/FINAL/dashboard/api/mensajes/mark_as_read.php?id=<?php echo $message['id']; ?>">Marcar como leído</a> | 
                                <a href="/FINAL/dashboard/api/mensajes/delete_message.php?id=<?php echo $message['id']; ?>">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay mensajes disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="dashboard-header">
    <h1 class="title">📨 Mensajes de Contacto</h1>
    <p class="subtitle">Consulta, gestiona y responde a los mensajes recibidos desde la sección de contacto de tu plataforma.</p>

    <div class="stats">
        <div class="stat-card total">Total: <?php echo count($messages); ?></div>
        <div class="stat-card read">Leídos: <?php echo count(array_filter($messages, fn($m) => $m['leido'] == 1)); ?></div>
        <div class="stat-card unread">No Leídos: <?php echo count(array_filter($messages, fn($m) => $m['leido'] == 0)); ?></div>
    </div>
</div>

</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
