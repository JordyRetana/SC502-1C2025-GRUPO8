<header>
  <a href="/pages/home.php" class="logo">
    <i class="fas fa-laptop-code" style="font-size: 26px; color: #fff; vertical-align: middle; margin-right: 8px;"></i>
    <span style="color: #fff; font-weight: 600;">Platform Services</span>
  </a>
  <nav class="navbar">
    <a href="../pages/home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">
      <i class="fas fa-house"></i> Inicio
    <a href="../pages/plans.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'plans.php' ? 'active' : ''; ?>">
      <i class="fas fa-box-open"></i> Planes
    </a>
    <a href="../pages/contacto.php">
      <i class="fas fa-envelope"></i> Contacto
    </a>
    </a>
    <a href="../pages/auth/login.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">
      <i class="fas fa-right-to-bracket"></i> Inicio de Sesión
    </a>
  </nav>
</header>
