<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /FINAL/dashboard/index.php");
    exit;
}

$pageTitle = "Inicio de Sesión";
$cssFile = "../../assets/css/auth/login.css";
$additionalCSS = [
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
];
require_once '../../includes/header.php';
?>
<header class="top-header"></header>
<a href="/FINAL/Plataforma/pages/home.php" class="btn btn-dark position-absolute d-flex align-items-center justify-content-center"
   style="top: 20px; left: 20px; z-index: 999; border-radius: 50%; width: 40px; height: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
    <i class="fas fa-arrow-left"></i>
</a>

<div>
    <div class="starsec"></div>
    <div class="starthird"></div>
    <div class="starfourth"></div>
    <div class="starfifth"></div>
</div>

<div class="container text-center text-dark mt-5">
    <div class="row">
        <div class="col-lg-4 d-block mx-auto mt-5">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-md-12">
                    <div class="card">
                        <div class="card-body wow-bg" id="formBg">
                            <h3 class="colorboard" data-lang="login">Login</h3>
                            <p class="text-muted" data-lang="signin">Sign In to your account</p>
                            <form id="loginForm">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control textbox-dg" name="email" placeholder="Correo Electrónico" required>
                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control textbox-dg" name="password" placeholder="Contraseña" required>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block logn-btn" data-lang="loginbutton">Iniciar Sesión</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="#" class="btn btn-link box-shadow-0 px-0" data-lang="forgotpassword">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-3">
                                <p data-lang="noaccount">¿No tienes una cuenta?</p>
                                <a href="register.php" class="btn btn-secondary" data-lang="createaccount">Crear cuenta</a>
                            </div>
                            <div class="mt-4 btn-list">
                                <button type="button" class="socila-btn btn btn-icon btn-facebook fb-color"><i class="fab fa-facebook-f faa-ring animated"></i></button>
                                <button type="button" class="socila-btn btn btn-icon btn-google incolor"><i class="fab fa-linkedin-in faa-flash animated"></i></button>
                                <button type="button" class="socila-btn btn btn-icon btn-twitter tweetcolor"><i class="fab fa-twitter faa-shake animated"></i></button>
                                <button type="button" class="socila-btn btn btn-icon btn-dribbble driblecolor"><i class="fab fa-dribbble faa-pulse animated"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        email: this.email.value,
        password: this.password.value
    };
    fetch('/FINAL/Plataforma/api/auth/login.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
})

    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            alert(data.error || 'Error al iniciar sesión');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al conectar con el servidor');
    });
});
</script>

<?php
?>