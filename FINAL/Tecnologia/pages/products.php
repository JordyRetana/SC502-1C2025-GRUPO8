<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$pageTitle = "Tecnología - Productos";
$cssFile = "../assets/css/pages/products.css";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container py-5">
    <section class="product-filters custom-filters mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar productos...">
                    <button class="btn btn-primary" id="searchButton">Buscar</button>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-outline-secondary me-2" id="sortLowHigh">Precio: Bajo a Alto</button>
                <button class="btn btn-outline-secondary" id="sortHighLow">Precio: Alto a Bajo</button>
            </div>
        </div>
    </div>
</section>

    <section id="productGrid" class="row g-4">
    </section>

<button class="pay-btn" id="openModalBtn">
  <span class="btn-text">Pay Now</span>
  <div class="icon-container">
    <svg viewBox="0 0 24 24" class="icon card-icon">
      <path d="M2 5h20v14H2z" fill="#fff" stroke="#333" stroke-width="2"/>
      <path d="M2 9h20" stroke="#999" stroke-width="1"/>
    </svg>
    <svg viewBox="0 0 24 24" class="icon payment-icon">
      <circle cx="12" cy="12" r="10" fill="#4CAF50"/>
      <path d="M8 12l2 2 4-4" fill="none" stroke="#fff" stroke-width="2"/>
    </svg>
    <svg viewBox="0 0 24 24" class="icon dollar-icon">
      <text x="6" y="18" font-size="16" fill="#fff" font-family="Arial">$</text>
    </svg>
    <svg viewBox="0 0 24 24" class="icon wallet-icon default-icon">
      <path d="M2 7h20v10H2z" fill="#333"/>
      <path d="M16 10h4v4h-4z" fill="#4CAF50"/>
    </svg>
    <svg viewBox="0 0 24 24" class="icon check-icon">
      <circle cx="12" cy="12" r="10" fill="#4CAF50"/>
      <path d="M8 12l2 2 4-4" fill="none" stroke="#fff" stroke-width="2"/>
    </svg>
  </div>
</button>

<div class="modal-overlay" id="modal">
  <div class="master-container card cart">
    <div class="title">Tu Carrito</div>
    <div class="products">
    </div>

    <div class="coupons">
      <form>
        <input class="input_field" type="text" placeholder="Cupón" />
        <button type="button">Aplicar</button>
      </form>
    </div>

    <div class="checkout">
      <div class="details">
        <span>Subtotal:</span><span>$0.00</span>
        <span>Envío:</span><span>$2.00</span>
        <span>Total:</span><span>$2.00</span>
      </div>
      <div class="checkout--footer">
        <div class="price"><sup>$</sup>0<sub>USD</sub></div>
        <button class="checkout-btn">Pagar ahora</button>
      </div>
    </div>

    <button class="btn-close" id="closeModal">Cerrar</button>
  </div>
</div>
</main>

<?php
$jsFile = "../assets/js/productos.js";
require_once '../includes/footer.php';
?>
