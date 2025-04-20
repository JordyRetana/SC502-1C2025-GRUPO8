<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto position-relative">
        <li class="nav-item">
          <a class="nav-link" href="../pages/home.php">Inicio</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="../pages/products.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/solutions.php">Soluciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/community.php">Comunidad</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/contact.php">Contacto</a>
        </li>

        <div class="nav-indicator"></div>
      </ul>

      <div class="d-flex align-items-center">
        <?php if (!isset($_SESSION['user_id'])): ?>
          <button class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</button>
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</button>
        <?php else: ?>
          <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>
              <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <a class="dropdown-item text-danger" href="/FINAL/Tecnologia/pages/logout.php">
                  <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                </a>
              <li><hr class="dropdown-divider"></li>
              
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>