<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageTitle = "Tecnología - Comunidad";
$cssFile = "../assets/css/pages/community.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container py-5 custom-margin-top">
    <h1 class="text-center mb-5">Nuestra Comunidad Tecnológica</h1>
    <p class="lead text-center mb-5">Únete a nuestra comunidad de entusiastas de la tecnología y mantente al día con las últimas tendencias, noticias y eventos.</p>

    <section class="mb-5">
    <h2 class="text-center mb-4">Foros de Discusión</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center p-4">
                    <h3 class="card-title">Foro de Hardware</h3>
                    <p class="card-text">Discute sobre los últimos componentes de hardware, comparte tus configuraciones y recibe consejos de otros miembros de la comunidad.</p>
                    <a href="#" class="btn btn-outline-light mt-3" data-bs-toggle="modal" data-bs-target="#registroModal">Únete al Foro</a>
                    </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <div class="card">
                <div class="card-body text-center p-4">
                    <h3 class="card-title">Foro de Software</h3>
                    <p class="card-text">Comparte tus experiencias con diferentes programas y aplicaciones, y obtén ayuda para resolver problemas de software.</p>
                    <a href="#" class="btn btn-outline-light mt-3" data-bs-toggle="modal" data-bs-target="#registroModal">Únete al Foro</a>
                    </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <h2 class="text-center mb-4">Próximos Eventos</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center p-4">
                    <h3 class="card-title">Webinar de Innovación Tecnológica</h3>
                    <p class="card-text">Únete a nuestro próximo webinar donde discutiremos las últimas innovaciones en tecnología y cómo pueden beneficiar a tu negocio.</p>
                    <p class="text-muted"><i class="far fa-calendar-alt me-2"></i>25 de marzo de 2025</p>
                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#registroModal">Registrarse</a>
                    </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end"> 
            <div class="card">
                <div class="card-body text-center p-4">
                    <h3 class="card-title">Conferencia de Desarrolladores</h3>
                    <p class="card-text">Participa en nuestra conferencia anual de desarrolladores y aprende de los expertos en la industria sobre las mejores prácticas y nuevas tecnologías.</p>
                    <p class="text-muted"><i class="far fa-calendar-alt me-2"></i>15 de abril de 2025</p>
                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#registroModal">Registrarse</a>
                    </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Formulario de Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroForm" action="enviar_registro.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios</label>
                        <textarea class="form-control" id="comentarios" name="comentarios" rows="3" required></textarea>
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
