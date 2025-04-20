<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Plataforma/pages/auth/login.php');
    exit;
}

require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';

$conn = getDBConnection();

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $message_id = intval($_GET['id']);

    $sql = "DELETE FROM mensajes_contacto WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $message_id);

    if ($stmt->execute()) {
        header('Location:/FINAL/dashboard/index.php');
        exit;
    } else {
        echo "Error al eliminar el mensaje.";
    }

    $stmt->close();
}

$conn->close();
?>
