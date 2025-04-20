<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuario';
$current_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
?>
<div class="sidebar">
    <div class="sidebar-header">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <span class="user-name"><?php echo htmlspecialchars($current_user); ?></span>
                <span class="user-email"><?php echo htmlspecialchars($current_email); ?></span>
            </div>
        </div>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'index.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/index.php"><i class="fas fa-tachometer-alt"></i><span>Mensajes</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'productos.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/sections/productos.php"><i class="fas fa-boxes"></i><span>Productos</span></a>
            </li>

            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'suscripciones.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/sections/suscripciones.php"><i class="fas fa-user-check"></i><span>Suscripciones</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'usuarios.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/sections/usuarios.php"><i class="fas fa-users-cog"></i><span>Usuarios</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'pendientes.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/sections/usuarios_pendientes.php"><i class="fas fa-user-clock"></i><span>Pendientes</span></a>
            </li>
            <li class="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'ventas.php' ? 'active' : ''; ?>">
                <a href="/FINAL/dashboard/sections/ventas.php"><i class="fas fa-shopping-cart"></i><span>Ventas</span></a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="/FINAL/dashboard/logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </a>
    </div>
</div>

