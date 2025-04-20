<?php
$pageTitle = "Contacto";
$cssFile = "../assets/css/pages/contacto.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<section class="contact-section">
  <div class="contact-container">
    <h2><i class="fas fa-envelope"></i> <span data-lang="contact">Contacto</span></h2>
    <p data-lang="contact-description">¿Tienes dudas, sugerencias o necesitas ayuda? Estamos aquí para ayudarte.</p>

    <form class="contact-form" method="post" action="../api/contacto/enviar_contacto.php">
      <div class="form-group">
        <label for="name" data-lang="name">Nombre</label>
        <input type="text" id="name" name="name" required placeholder="Tu nombre">
      </div>

      <div class="form-group">
        <label for="email" data-lang="email">Correo electrónico</label>
        <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
      </div>

      <div class="form-group">
        <label for="message" data-lang="message">Mensaje</label>
        <textarea id="message" name="message" rows="5" required placeholder="Escribe tu mensaje..."></textarea>
      </div>

      <button type="submit" class="btn-submit" data-lang="send">Enviar mensaje</button>
    </form>
  </div>
</section>


<?php require_once '../includes/footer.php'; ?>
