<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $comentarios = $_POST['comentarios'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'tecnocore32@gmail.com';
        $mail->Password = 'gmae wwel muxm yjto';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tecnocore32@gmail.com', 'Tecnocore');
        $mail->addAddress('tecnocore32@gmail.com', 'Tecnocore');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo Registro - Comunidad Tecnológica';
        $mail->Body    = "Nuevo registro de usuario:<br>
                          Nombre: $nombre<br>
                          Correo: $correo<br>
                          Comentarios: $comentarios";

        $mail->send();
        echo 'Mensaje enviado exitosamente';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
