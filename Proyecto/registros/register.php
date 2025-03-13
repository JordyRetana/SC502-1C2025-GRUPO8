<?php
$host = "localhost:3315"; 
$user = "root"; 
$password = ""; 
$database = "proyecto";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST['first-name'];
$apellido = $_POST['last-name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['phone'];
$direccion = $_POST['address'];

$check_email = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    echo "Error: Este correo ya está registrado. <a href='../Login.html'>Iniciar sesión</a>";
} else {
    $sql = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, contraseña, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssss", $nombre, $apellido, $email, $password, $telefono, $direccion);
    
    if ($sql->execute()) {
        header("Location: ../Plataforma/Login.html");
        exit();
    } else {
        echo "Error al registrar el usuario.";
    }
}

$check_email->close();
$conn->close();
?>
