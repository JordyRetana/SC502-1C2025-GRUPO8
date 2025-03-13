<?php
$host = "localhost:3315"; 
$user = "root"; 
$password = ""; 
$database = "proyecto";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['contraseña'])) {
        header("Location: ../Plataforma/dashboard.html"); 
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No se encontró el usuario.";
}

$stmt->close();
$conn->close();
?>
