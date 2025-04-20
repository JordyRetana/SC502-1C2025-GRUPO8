<?php
require_once __DIR__ . '../config/shared_db.php';

$conn = getDBConnection();

$query = "SELECT id, first_name, last_name, email, estado FROM usuarios_pendientes";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $users]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se encontraron usuarios']);
}

$conn->close();
?>
