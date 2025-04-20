<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();

    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $categoria = $_POST['categoria'] ?? '';
    $stock = $_POST['stock'] ?? 0;

    if (!$id) {
        echo "ID de producto no proporcionado.";
        exit;
    }

    $sql = "UPDATE productos 
            SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, stock = ?, fecha_actualizacion = NOW() 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssdsii", $nombre, $descripcion, $precio, $categoria, $stock, $id);

    if ($stmt->execute()) {
        header("Location: /FINAL/dashboard/sections/productos.php?edit=success");
        exit;
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
