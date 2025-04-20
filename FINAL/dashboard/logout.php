<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];

session_destroy();

header("Location: ../Plataforma/pages/auth/login.php?logout=1");
exit;
?>
