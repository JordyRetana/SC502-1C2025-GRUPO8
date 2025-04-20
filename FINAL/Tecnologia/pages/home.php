<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /FINAL/Tecnologia/pages/auth/login.php");
    exit();
}

$pageTitle = "Tecnología - Inicio";
$cssFile = "../assets/css/pages/home.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="main-content">
  <section class="hero-section">
    <div class="container hero-content">
      <div class="hero-image">
        <img src="../assets/img/Tecno.png" alt="Tecnología">
      </div>
      <div class="hero-text">
        <h1>Impulsa tu Negocio con Nuestra Tecnología Innovadora</h1>
        <p class="lead">Descubre cómo nuestra tecnología puede transformar tus operaciones y hacer crecer tu empresa.</p>
      </div>
    </div>
  </section>

  <section class="swiper-section py-4">
    <div class="container mx-auto px-4 carrusel-container">
      <div class="swiper vertical-slide-carousel swiper-container relative h-96 w-full">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="rounded-2xl h-96 overflow-hidden flex justify-center items-center">
              <img src="https://www.techzilla.cr/wp-content/uploads/2022/09/b3_0000_l2.png" alt="Slide 1" class="object-cover w-full h-full shadow-lg rounded-lg">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="rounded-2xl h-96 overflow-hidden flex justify-center items-center">
              <img src="https://www.techzilla.cr/wp-content/uploads/2022/09/b2_0001_l2.png" alt="Slide 2" class="object-cover w-full h-full shadow-lg rounded-lg">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="rounded-2xl h-96 overflow-hidden flex justify-center items-center">
              <img src="https://www.techzilla.cr/wp-content/uploads/2022/09/b2_0000_l3.png" alt="Slide 3" class="object-cover w-full h-full shadow-lg rounded-lg">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="rounded-2xl h-96 overflow-hidden flex justify-center items-center">
              <img src="https://www.ticotek.com/wp-content/uploads/2025/01/a50x_02.jpg" alt="Slide 4" class="object-cover w-full h-full shadow-lg rounded-lg">
            </div>
          </div>
        </div>
        <div class="swiper-pagination !right-10 !left-full !top-1/3 !translate-y-8"></div>
      </div>
    </div>
  </section>
  
</main>

<?php
$jsFile = "../assets/js/filtro/carrusell.js";
require_once '../includes/footer.php';
?>