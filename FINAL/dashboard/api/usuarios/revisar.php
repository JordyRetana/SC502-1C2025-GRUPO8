<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("UPDATE usuarios_pendientes SET estado = 'revisar' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: /FINAL/dashboard/sections/usuarios_pendientes.php?success=1");
    } else {
        echo "Error al actualizar el estado.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
