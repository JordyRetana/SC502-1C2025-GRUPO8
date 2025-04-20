<?php
require_once '../../config/shared_db.php';

header('Content-Type: application/json');

function handleError($message, $status = 'error') {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        handleError('Método no permitido');
    }

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        handleError('Todos los campos son obligatorios');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        handleError('Correo electrónico inválido');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $conn = getDBConnection();
    if ($conn->connect_error) {
        handleError('Error de conexión a la base de datos');
    }

    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        handleError('Error al preparar la consulta');
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        handleError('El correo electrónico ya está registrado');
    }

    $query = "INSERT INTO usuarios (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        handleError('Error al preparar la consulta de inserción');
    }
    
    $stmt->bind_param("sss", $name, $email, $passwordHash);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario registrado exitosamente']);
    } else {
        handleError('Error al registrar el usuario: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    handleError('Error interno del servidor: ' . $e->getMessage());
}