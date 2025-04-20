<?php
require_once 'C:/xampp/htdocs/FINAL/dashboard/config/shared_db.php';
$conn = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $plan = $_POST['plan'];

    $sql = "UPDATE suscripciones SET nombre=?, correo=?, telefono=?, plan=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $correo, $telefono, $plan, $id);

    if ($stmt->execute()) {
        header("Location: /FINAL/dashboard/sections/suscripciones.php?edit=success");
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
} else {
    echo "Petición inválida.";
}
