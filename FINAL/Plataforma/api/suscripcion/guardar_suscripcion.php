<?php
require_once '../../config/database.php';

if (!function_exists('getDBConnection')) {
  function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
      http_response_code(500);
      echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
      exit;
    }
    $conn->set_charset("utf8");
    return $conn;
  }
}

header('Content-Type: application/json'); // 🟢 Muy importante

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'] ?? '';
  $correo = $_POST['correo'] ?? '';
  $telefono = $_POST['telefono'] ?? '';
  $plan = $_POST['plan'] ?? '';

  $conn = getDBConnection();
  $stmt = $conn->prepare("INSERT INTO suscripciones (nombre, correo, telefono, plan, fecha_suscripcion) VALUES (?, ?, ?, ?, NOW())");
  $stmt->bind_param("ssss", $nombre, $correo, $telefono, $plan);

  if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Suscripción guardada correctamente.']);
  } else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $conn->error]);
  }

  $stmt->close();
  $conn->close();
} else {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
