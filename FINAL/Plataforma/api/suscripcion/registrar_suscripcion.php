<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../lib/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    file_put_contents(__DIR__ . '/debug_post.txt', print_r($_POST, true)); // Esto te ayudará a ver los datos

    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['plan'])) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos del formulario']);
        exit;
    }
    
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $plan = $_POST['plan'];
    
    $fechaSuscripcion = date("d-m-Y H:i:s");

    $mensajeAdmin = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
            .container { max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
            h2 { color: #2c3e50; text-align: center; font-size: 24px; margin-bottom: 20px; }
            p { font-size: 16px; line-height: 1.6; margin-bottom: 10px; }
            .info { font-weight: bold; color: #2980b9; }
            .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #7f8c8d; }
            .footer a { color: #2980b9; text-decoration: none; }
            .button { display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #2980b9; color: #fff; text-decoration: none; border-radius: 5px; }
            .button:hover { background-color: #3498db; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>¡Nuevo usuario suscrito!</h2>
            <p><span class='info'>Nombre:</span> $nombre</p>
            <p><span class='info'>Correo:</span> $correo</p>
            <p><span class='info'>Teléfono:</span> $telefono</p>
            <p><span class='info'>Plan:</span> $plan</p>
            <p><span class='info'>Fecha de suscripción:</span> $fechaSuscripcion</p>
            <a href='#' class='button'>Ver detalles</a>
            <div class='footer'>
                <p>Este correo fue generado automáticamente por el sistema de suscripción de la plataforma. Si tienes dudas, no dudes en contactarnos.</p>
                <p>&copy; 2025 Plataforma</p>
            </div>
        </div>
    </body>
    </html>
    ";

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'error_log';

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pltfrmservices@gmail.com';
        $mail->Password   = 'elok byzk mpeq qkef';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('pltfrmservices@gmail.com', 'Suscripción Plataforma');
        $mail->addAddress('pltfrmservices@gmail.com');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Nueva suscripción - $plan";
        $mail->Body    = $mensajeAdmin;

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Correo enviado correctamente.']);
        $mail->send();

$mailUser = new PHPMailer(true);
$mailUser->isSMTP();
$mailUser->Host       = 'smtp.gmail.com';
$mailUser->SMTPAuth   = true;
$mailUser->Username   = 'pltfrmservices@gmail.com';
$mailUser->Password   = 'elok byzk mpeq qkef';
$mailUser->SMTPSecure = 'tls';
$mailUser->Port       = 587;

$mailUser->setFrom('pltfrmservices@gmail.com', 'Plataforma');
$mailUser->addAddress($correo, $nombre);
$mailUser->isHTML(true);
$mailUser->CharSet = 'UTF-8';
$mailUser->Subject = '¡Gracias por suscribirte a nuestra plataforma!';

$mensajeUsuario = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px; }
        h2 { color: #2c3e50; }
        p { font-size: 16px; color: #333; line-height: 1.5; }
        .info { color: #2980b9; font-weight: bold; }
        .footer { margin-top: 20px; font-size: 12px; color: #888; text-align: center; }
    </style>
</head>
<body>
    <div class='container'>
        <h2>¡Hola $nombre!</h2>
        <p>Gracias por suscribirte al plan <span class='info'>$plan</span>.</p>
        <p>Tu suscripción será activada en breve. Mientras tanto, si tienes dudas, puedes contactarnos respondiendo este correo.</p>
        <p>Estos son los datos que nos proporcionaste:</p>
        <ul>
            <li><span class='info'>Correo:</span> $correo</li>
            <li><span class='info'>Teléfono:</span> $telefono</li>
            <li><span class='info'>Fecha:</span> $fechaSuscripcion</li>
        </ul>
        <p>¡Gracias por confiar en nosotros!</p>
        <div class='footer'>
            &copy; 2025 Plataforma. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
";

$mailUser->Body = $mensajeUsuario;
$mailUser->send();

    } catch (Exception $e) {
        echo json_encode([ 
            'success' => false,
            'message' => 'Error al enviar el correo: ' . $mail->ErrorInfo
        ]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido.']);
}
?>
