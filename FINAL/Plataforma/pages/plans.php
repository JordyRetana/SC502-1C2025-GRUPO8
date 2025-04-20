<?php 
$pageTitle = "Planes";
$cssFile = "../assets/css/pages/plans.css";

require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<section class="pricing-section">
  <div class="container">
    <h1 class="text-center mb-4" data-lang="pricing">Planes de Precios</h1>
    <p class="text-center mb-5" data-lang="description">Descubre cómo nuestra tecnología puede transformar tus operaciones y mejorar tu eficiencia.</p>
    <p class="text-center mb-5" data-lang="description2">Di adiós al caos de los registros manuales y abraza una forma más inteligente y efectiva de administrar.</p>

    <div class="cards__inner d-flex gap-4 flex-wrap justify-content-center">
      <div class="card">
        <p class="card__heading" data-lang="demo">Demo</p>
        <p class="card__price" data-lang="price">$0.0 /mes</p>
        <ul class="card__bullets flow" role="list">
          <li data-lang="demodescription">Gestión de hasta 15 usuarios por 1 mes de forma gratuita</li>
          <li>Soporte por Correo Electrónico</li>
          <li>Almacenamiento en la Nube</li>
        </ul>
        <button class="card__cta cta open-subscribe-modal" data-bs-toggle="modal" data-bs-target="#subscribeModal" data-plan="Demo">Suscribirse</button>
      </div>

      <div class="card">
        <p class="card__heading" data-lang="basic">Basic</p>
        <p class="card__price" data-lang="price">$14.0 /mes</p>
        <ul class="card__bullets flow" role="list">
          <li data-lang="basicdescription">El plan Basic te permite gestionar hasta 20 usuarios.</li>
          <li>Centro de Ayuda</li>
        </ul>
        <button class="card__cta cta open-subscribe-modal" data-bs-toggle="modal" data-bs-target="#subscribeModal" data-plan="Basic">Suscribirse</button>
      </div>

      <div class="card">
        <p class="card__heading" data-lang="pro">Pro</p>
        <p class="card__price" data-lang="price">$56.0 /mes</p>
        <ul class="card__bullets flow" role="list">
          <li data-lang="prodescription">Gestiona hasta 120 usuarios con soporte completo y almacenamiento ilimitado.</li>
          <li>Soporte Personalizado</li>
          <li>Sin anuncios</li>
        </ul>
        <button class="card__cta cta open-subscribe-modal" data-bs-toggle="modal" data-bs-target="#subscribeModal" data-plan="Pro">Suscribirse</button>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="subscribeModalLabel">Términos y Condiciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <div class="modal-body" id="terms-step">
        <p>Al suscribirte, aceptas nuestros términos de uso y políticas de privacidad. Tu información será tratada de forma segura y confidencial.</p>
        <div class="mb-4">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="acceptTerms">Aceptar</button>
        </div>
      </div>
      
      <div class="modal-body" id="form-step" style="display:none;">
        <h4 class="text-lg font-semibold mb-4">Completa tu información</h4>
        <form id="subscribeForm" method="POST" action="../api/suscripcion/registrar_suscripcion.php">
    <input type="hidden" id="planSeleccionado" name="plan">
    <div class="mb-4">
        <label class="block mb-1 text-sm">Nombre</label>
        <input type="text" class="form-control" name="nombre" placeholder="Tu nombre completo" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm">Correo</label>
        <input type="email" class="form-control" name="correo" placeholder="correo@ejemplo.com" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm">Teléfono</label>
        <input type="text" class="form-control" name="telefono" placeholder="+506 8888 8888" required maxlength="15">
    </div>
    <div class="d-flex justify-content-end gap-4 pt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>


      </div>

    </div>
  </div>
</div>





<section class="comparison-section">
    <div class="container">
        <h2 class="text-center mb-5" data-lang="compare">Comparar planes</h2>
        <table class="table table-bordered table-striped table-hover comparison-table">
            <thead class="table-dark">
                <tr>
                    <th scope="col" data-lang="features">Características</th>
                    <th scope="col" data-lang="demo">Demo</th>
                    <th scope="col" data-lang="basic">Basic</th>
                    <th scope="col" data-lang="pro">Pro</th>
                </tr>
            </thead>
            <tbody>
                <tr><td data-lang="emailsupport">Soporte por Correo Electrónico</td><td>✔️</td><td>✔️</td><td>✔️</td></tr>
                <tr><td data-lang="personalsupport">Soporte Personalizado</td><td>❌</td><td>✔️</td><td>✔️</td></tr>
                <tr><td data-lang="cloudstorage">Almacenamiento en la Nube</td><td>✔️</td><td>✔️</td><td>✔️</td></tr>
                <tr><td data-lang="prioritysupport">Soporte Prioritario</td><td>❌</td><td>❌</td><td>✔️</td></tr>
                <tr><td data-lang="helpcenter">Acceso a Centro de Ayuda</td><td>❌</td><td>✔️</td><td>✔️</td></tr>
            </tbody>
        </table>
    </div>
</section>



<?php require_once '../includes/footer.php'; ?>
