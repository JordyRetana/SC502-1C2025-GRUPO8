<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: /FINAL/dashboard/sections/productos.php?delete=success");
        exit;
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
}
