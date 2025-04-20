<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageTitle = "Tecnología - Soluciones";
$cssFile = "../assets/css/pages/solutions.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container py-5">
<section class="bg-solutions py-5 text-white">
  <div class="container">
    <h1 class="text-center mb-4">Nuestras Soluciones Tecnológicas</h1>
    <p class="lead text-center mb-5">Brindamos soluciones innovadoras y efectivas para mejorar el crecimiento y la eficiencia de tu negocio en el ámbito tecnológico.</p>

    <div class="row g-4">
  <div class="col-md-4">
    <div class="card solution-card h-100 shadow-lg border-0">
      <div class="card-body text-center p-4">
        <div class="icon-circle mb-3 mx-auto">
          <i class="fas fa-shopping-cart fa-2x text-white"></i>
        </div>
        <h3 class="card-title">Solución de E-commerce</h3>
        <p class="card-text">Optimiza tu tienda en línea con nuestras soluciones de e-commerce, mejorando la experiencia del usuario y aumentando las ventas.</p>
        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#infoModal">Más información</button>
        </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card solution-card h-100 shadow-lg border-0">
      <div class="card-body text-center p-4">
        <div class="icon-circle mb-3 mx-auto">
          <i class="fas fa-robot fa-2x text-white"></i>
        </div>
        <h3 class="card-title">Automatización de Procesos</h3>
        <p class="card-text">Automatiza los procesos empresariales y aumenta la productividad con nuestras herramientas de automatización.</p>
        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#infoModal">Más información</button>
        </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card solution-card h-100 shadow-lg border-0">
      <div class="card-body text-center p-4">
        <div class="icon-circle mb-3 mx-auto">
          <i class="fas fa-database fa-2x text-white"></i>
        </div>
        <h3 class="card-title">Gestión de Datos</h3>
        <p class="card-text">Gestiona tus datos de manera segura y eficiente con nuestras soluciones de almacenamiento y análisis de datos.</p>
        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#infoModal">Más información</button>
        </div>
    </div>
  </div>
</div>

</section>


<section class="mb-5">
  <h2 class="text-center mb-4">Lo que dicen nuestros clientes</h2>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="testimonial-card">
        <div class="bg uwu"></div>
        <div class="bg"></div>
        <div class="content">
          <div class="img">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="50" alt="Cliente">
          </div>
          <div class="h1">
            Alex Johnson
          </div>
          <div class="p">
            CEO de TechCorp
            <p>
              La solución de TecnoCore transformó nuestra tienda en línea, mejorando la experiencia del cliente y aumentando nuestras ventas.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="testimonial-card">
        <div class="bg uwu"></div>
        <div class="bg"></div>
        <div class="content">
          <div class="img">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="50" alt="Cliente">
          </div>
          <div class="h1">
            Maria López
          </div>
          <div class="p">
            Gerente de Operaciones
            <p>
              La automatización de procesos nos permitió ahorrar tiempo y recursos, aumentando nuestra eficiencia operativa.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Enviar más información</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="infoForm">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Comentario</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Número de Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>


</main>

<?php
require_once '../includes/footer.php';
?>