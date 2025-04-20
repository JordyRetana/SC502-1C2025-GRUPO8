<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /pages/dashboard.php");
    exit;
}

$pageTitle = "Crear Cuenta";
$cssFile = "../../assets/css/auth/register.css";
$additionalCSS = [
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
];
require_once '../../includes/header.php';
?>

<header class="top-header">
</header>

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
              <h3 class="colorboard" data-lang="createaccount">Crear Cuenta</h3>
              <p class="text-muted" data-lang="createaccountdescription">Crea tu cuenta</p>
              
              <div id="authError" class="alert alert-danger" style="display: none; margin-top: 1rem;"></div>

              <form id="registerForm">
                <div class="input-group mb-3"> 
                  <input type="text" class="form-control textbox-dg" name="first_name" placeholder="Nombre" required data-lang="firstname"> 
                </div>
                <div class="input-group mb-3"> 
                  <input type="text" class="form-control textbox-dg" name="last_name" placeholder="Apellido" required data-lang="lastname"> 
                </div>
                <div class="input-group mb-3"> 
                <input type="email" class="form-control textbox-dg" name="email" placeholder="Correo Electrónico" required data-lang="email" autocomplete="username">
                </div>
                <div class="input-group mb-3"> 
                <input type="password" class="form-control textbox-dg" name="password" placeholder="Contraseña" required data-lang="password" autocomplete="new-password">
                </div>
                <div class="input-group mb-4"> 
                <input type="password" class="form-control textbox-dg" name="confirm_password" placeholder="Confirmar Contraseña" required data-lang="confirmpassword" autocomplete="new-password">
                </div>
                
                <div class="row">
                  <div class="col-12"> 
                    <button type="submit" class="btn btn-primary btn-block logn-btn" data-lang="createaccountbutton">Crear Cuenta</button> 
                  </div>
                  <div class="col-12 mt-3"> 
                    <p data-lang="alreadyhaveaccount">¿Ya tienes una cuenta? <a href="login.php" class="btn btn-link box-shadow-0 px-0" data-lang="loginhere">Inicia sesión aquí</a></p>
                  </div>
                </div>
              </form>

              <div class="mt-6 btn-list">
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



<script src="/FINAL/Plataforma/assets/js/auth/auth.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const passwordInput = registerForm.querySelector('input[name="password"]');
    const confirmPasswordInput = registerForm.querySelector('input[name="confirm_password"]');
    
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value && this.value.length > 0) {
            this.setCustomValidity('Las contraseñas no coinciden');
        } else {
            this.setCustomValidity('');
        }
    });
    
    registerForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';
        
        if (passwordInput.value !== confirmPasswordInput.value) {
            Auth.showAuthError('Las contraseñas no coinciden');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
            return;
        }
        
        const userData = {
            first_name: this.first_name.value,
            last_name: this.last_name.value,
            email: this.email.value,
            password: passwordInput.value,
            confirm_password: confirmPasswordInput.value
        };
        
        try {
            const response = await Auth.register(userData);
            
            if (!Auth.handleAuthErrors(response)) {
                Auth.showAuthError('Registro exitoso! Redirigiendo al login...', 'success');
                setTimeout(() => {
                    window.location.href = response.redirect || '../../pages/auth/login.php';
                }, 1500);
            }
        } catch (error) {
            console.error('Error:', error);
            Auth.showAuthError('Error de conexión con el servidor');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
});
</script>

<?php
?>