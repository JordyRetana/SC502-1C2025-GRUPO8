<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito";
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>
