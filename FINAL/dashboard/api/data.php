<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$db = new Database();
$conn = $db->getConnection();

$response = [];

try {
    $result = $conn->query("SELECT * FROM chart_data");
    $data = [];
    
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    $response = [
        'success' => true,
        'data' => $data
    ];
} catch(Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

$db->close();
echo json_encode($response);
?>