<?php
require_once '../../config/shared_db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn = getDBConnection();
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            throw new Exception('Email y contraseña son requeridos');
        }

        $stmt = $conn->prepare("SELECT id, email, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception('Credenciales incorrectas');
        }

        $user = $result->fetch_assoc();

        if (!password_verify($password, $user['password'])) {
            throw new Exception('Credenciales incorrectas');
        }

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        echo json_encode([
            'status' => 'success', 
            'message' => 'Login exitoso',
            'redirect' => '/FINAL/Tecnologia/pages/home.php'
        ]);

    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    } finally {
        if (isset($stmt)) $stmt->close();
        if (isset($conn)) $conn->close();
    }
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Método no permitido'
    ]);
}
?>