<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);


require __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../lib/PHPMailer/src/SMTP.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $phone = $_POST['phone'];

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
        $mail->Subject = 'Nuevo mensaje de cliente';
        $mail->Body = "
            <h3>Detalles del Cliente:</h3>
            <p><strong>Nombre:</strong> $name</p>
            <p><strong>Comentario:</strong> $comment</p>
            <p><strong>Número de Teléfono:</strong> $phone</p>
        ";

        if ($mail->send()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
    }
}
?>
