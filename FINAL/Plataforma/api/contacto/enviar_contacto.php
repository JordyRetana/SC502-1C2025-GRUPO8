<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../config/database.php';
require __DIR__ . '/../../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/PHPMailer/src/SMTP.php';

if (!function_exists('getDBConnection')) {
    function getDBConnection() {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['name'] ?? '';
    $correo = $_POST['email'] ?? '';
    $mensaje = $_POST['message'] ?? '';
    $fecha = date("d-m-Y H:i:s");

    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO mensajes_contacto (nombre, correo, mensaje, fecha) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $nombre, $correo, $mensaje);
    $guardado = $stmt->execute();
    $stmt->close();
    $conn->close();

    if (!$guardado) {
        echo json_encode(['success' => false, 'message' => 'Error al guardar el mensaje.']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pltfrmservices@gmail.com';
        $mail->Password   = 'elok byzk mpeq qkef';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('pltfrmservices@gmail.com', 'Formulario de Contacto');
        $mail->addAddress('pltfrmservices@gmail.com', 'Administrador');
        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto";
        $mail->Body = "
        <html>
        <body style='font-family:Arial; background:#f4f4f4; padding:20px;'>
            <div style='max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;'>
                <h2 style='color:#2c3e50;'>Nuevo mensaje de contacto</h2>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Correo:</strong> $correo</p>
                <p><strong>Mensaje:</strong><br>$mensaje</p>
                <p><strong>Fecha:</strong> $fecha</p>
            </div>
        </body>
        </html>
        ";
        $mail->send();

        $mailUser = new PHPMailer(true);
        $mailUser->isSMTP();
        $mailUser->Host       = 'smtp.gmail.com';
        $mailUser->SMTPAuth   = true;
        $mailUser->Username   = 'pltfrmservices@gmail.com';
        $mailUser->Password   = 'elok byzk mpeq qkef';
        $mailUser->SMTPSecure = 'tls';
        $mailUser->Port       = 587;
        $mailUser->CharSet    = 'UTF-8';

        $mailUser->setFrom('pltfrmservices@gmail.com', 'Plataforma');
        $mailUser->addAddress($correo, $nombre);
        $mailUser->isHTML(true);
        $mailUser->Subject = "Hemos recibido tu mensaje";

        $mailUser->Body = "
        <html>
        <body style='font-family:Arial; background:#f4f4f4; padding:20px;'>
            <div style='max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;'>
                <h2 style='color:#2c3e50;'>Hola $nombre,</h2>
                <p>Gracias por contactarnos. Hemos recibido tu mensaje:</p>
                <blockquote style='color:#555;'>$mensaje</blockquote>
                <p>Nos pondremos en contacto contigo lo antes posible.</p>
                <p><strong>Fecha de envío:</strong> $fecha</p>
                <hr>
                <p style='font-size:12px; color:#888;'>Este mensaje fue generado automáticamente. No respondas a este correo.</p>
            </div>
        </body>
        </html>
        ";

        $mailUser->send();

        echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al enviar los correos: ' . $mail->ErrorInfo
        ]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
