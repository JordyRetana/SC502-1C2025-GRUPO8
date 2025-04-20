<?php
require_once '../../config/shared_db.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['cart']) || !is_array($data['cart'])) {
        throw new Exception("Carrito inválido.");
    }

    $conn->begin_transaction();

    try {
        foreach ($data['cart'] as $item) {
            $id = intval($item['id']);
            $cantidad = intval($item['quantity']);

            $stmt = $conn->prepare("SELECT stock, precio FROM productos WHERE id = ? FOR UPDATE");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $producto = $result->fetch_assoc();

            if (!$producto) {
                throw new Exception("Producto ID $id no encontrado.");
            }

            if ($producto['stock'] < $cantidad) {
                throw new Exception("Stock insuficiente para el producto ID $id.");
            }

            $update = $conn->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
            $update->bind_param("ii", $cantidad, $id);
            $update->execute();

            $insert = $conn->prepare("INSERT INTO ventas (producto_id, cantidad, precio_unitario, fecha) VALUES (?, ?, ?, NOW())");
            $insert->bind_param("iid", $id, $cantidad, $producto['precio']);
            $insert->execute();
        }

        $conn->commit();

        echo json_encode([
            'success' => true, 
            'message' => 'Compra realizada con éxito',
            'total_items' => count($data['cart'])
        ]);

    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false, 
        'error' => $e->getMessage(),
        'cart' => $data['cart'] ?? null
    ]);
} finally {
    if (isset($conn)) $conn->close();
}
?>