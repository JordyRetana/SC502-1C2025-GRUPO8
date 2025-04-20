<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageTitle = "Tecnología - Contacto";
$cssFile = "../assets/css/pages/contact.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container py-5">
    <h1 class="text-center mb-4">Contáctanos</h1>
    <p class="lead text-center mb-5">Estamos aquí para ayudarte. Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nosotros.</p>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="bg"></div>
                <div class="blob"></div>
                <div class="card-body p-4">
                    <h2 class="mb-4">Envía un mensaje</h2>
                    <form id="contact-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>

<div class="col-lg-6">
    <div class="card shadow-sm">
        <div class="card-body p-4 text-black"> 
            <h2 class="mb-4">Información de Contacto</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-start">
                    <i class="fas fa-map-marker-alt text-black me-3 mt-1"></i>
                    <div>
                            <h5 class="mb-1">Dirección</h5>
                            <p class="mb-0">123 Calle Principal, Ciudad, País</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start">
                    <i class="fas fa-phone text-black me-3 mt-1"></i>
                    <div>
                            <h5 class="mb-1">Teléfono</h5>
                            <p class="mb-0">+123 456 7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start">
                    <i class="fas fa-envelope text-black me-3 mt-1"></i>
                    <div>
                            <h5 class="mb-1">Correo Electrónico</h5>
                            <p class="mb-0">contacto@tiendatecnologia.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-start">
                    <i class="fas fa-clock text-black me-3 mt-1"></i>
                    <div>
                            <h5 class="mb-1">Horario de Atención</h5>
                            <p class="mb-0">Lun-Vie: 9:00 AM - 6:00 PM</p>
                            <p class="mb-0">Sáb: 10:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h5 class="mb-3">Síguenos en redes sociales</h5>
            <div class="d-flex gap-3">
                <a href="#" class="icon-black"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#" class="icon-black"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="icon-black"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="icon-black"><i class="fab fa-linkedin-in fa-lg"></i></a>
                <a href="#" class="icon-black"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
        </div>
    </div>
</div>

    </div>
</main>

<?php
require_once '../includes/footer.php';
?>

<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault(); 

        let formData = new FormData(this);

        fetch('/FINAL/Tecnologia/api/send.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); 
        })
        .catch(error => {
            alert("Hubo un problema con el envío del formulario.");
        });
    });
</script>
