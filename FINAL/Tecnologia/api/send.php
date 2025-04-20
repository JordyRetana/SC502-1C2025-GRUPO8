<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

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
        $mail->Subject = "Nuevo mensaje de contacto: $subject";
        $mail->Body    = "
            <h3>Nuevo mensaje de $name</h3>
            <p><strong>Correo:</strong> $email</p>
            <p><strong>Asunto:</strong> $subject</p>
            <p><strong>Mensaje:</strong></p>
            <p>$message</p>
        ";

        if ($mail->send()) {
            echo 'Mensaje enviado correctamente';
        } else {
            echo 'No se pudo enviar el mensaje. Inténtalo de nuevo más tarde.';
        }
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
