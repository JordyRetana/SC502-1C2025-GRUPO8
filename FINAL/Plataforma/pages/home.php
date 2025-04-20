<?php
$pageTitle = "Impulsa tu Negocio";
$cssFile = "../assets/css/pages/home.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<section class="hero-section">
    <div class="container">
        <h1 data-lang="title">
            <img src="../assets/img/services.png" alt="" width="200">
        </h1>
        <p class="lead" data-lang="subtitle">Impulsa tu Negocio con Nuestra Plataforma Innovadora</p>
        <p data-lang="description">Descubre cómo nuestra tecnología puede transformar tus operaciones y hacer crecer tu empresa.</p>
    </div>
</section>

<section class="benefits-section">
    <div class="container">
        <h2 class="text-center mb-5" data-lang="benefits">Beneficios Principales</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card benefit-card">
                    <div class="card-body">
                        <h5 class="card-title" data-lang="efficiency">Incremento de Eficiencia</h5>
                        <p class="card-text" data-lang="efficiency-description">Optimiza tus procesos y aumenta la productividad.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card benefit-card">
                    <div class="card-body">
                        <h5 class="card-title" data-lang="technology">Tecnología Innovadora</h5>
                        <p class="card-text" data-lang="technology-description">Utiliza las últimas herramientas para destacar en el mercado.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card benefit-card">
                    <div class="card-body">
                        <h5 class="card-title" data-lang="support">Soporte Continuo</h5>
                        <p class="card-text" data-lang="support-description">Asistencia técnica y soporte cuando lo necesites.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="partners-section">
    <div class="container">
        <h2 class="text-center mb-5">Empresas que confían en nosotros</h2>
        <div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
    <div class="d-flex justify-content-center">
        <a href="/FINAL/Tecnologia/index.php" target="_blank">
            <img src="../assets/img/logos/Tecno.png" class="logo-img" alt="Empresa 1">
        </a>
    </div>
</div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                    <a href="/FINAL/Plataforma/carga/carga.php" target="_blank">

                        <img src="../assets/img/logos/LOGO_2.PNG" class="logo-img" alt="Empresa 2">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                    <a href="/FINAL/Plataforma/carga/carga.php" target="_blank">

                        <img src="../assets/img/logos/LOGO_3.png" class="logo-img" alt="Empresa 3">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                    <a href="/FINAL/Plataforma/carga/carga.php" target="_blank">

                        <img src="../assets/img/logos/LOGO_4.png" class="logo-img" alt="Empresa 4">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#partnersCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#partnersCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>

<?php
require_once '../includes/footer.php';
?>
