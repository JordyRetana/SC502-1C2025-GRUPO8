<?php
require_once '../../config/database.php';

header('Content-Type: application/json');
$conn = getDBConnection();

$data = json_decode(file_get_contents('php://input'), true);

// Validación de campos
if (
    empty($data['first_name']) ||
    empty($data['last_name']) ||
    empty($data['email'])
) {
    echo json_encode(['success' => false, 'error' => 'validation_error']);
    exit;
}

$email = $data['email'];

$stmt = $conn->prepare("SELECT * FROM suscripciones WHERE correo = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'email_not_subscribed']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM usuarios_pendientes WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        'success' => false,
        'error' => 'user_already_registered',
    ]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO usuarios_pendientes (first_name, last_name, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data['first_name'], $data['last_name'], $email);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro exitoso. Ahora espere acceso.']);
} else {
    echo json_encode(['success' => false, 'error' => 'database_error']);
}
exit;
?>
