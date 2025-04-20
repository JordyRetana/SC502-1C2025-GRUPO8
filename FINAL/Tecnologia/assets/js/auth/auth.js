function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
  
  function mostrarMensaje(mensaje, tipo = "error") {
    const respuesta = document.getElementById("respuesta");
    respuesta.innerText = mensaje;
    respuesta.style.color = tipo === "success" ? "lightgreen" : "salmon";
  }
  
  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      e.preventDefault(); 
  
      const name = this.name.value.trim();
      const email = this.email.value.trim();
      const password = this.password.value.trim();
  
      if (!validarEmail(email)) return mostrarMensaje("Correo inválido");
  
      if (password.length < 6) return mostrarMensaje("La contraseña debe tener al menos 6 caracteres");
  
      if (name.length < 2) return mostrarMensaje("El nombre debe tener al menos 2 caracteres");
  
      const formData = new FormData();
      formData.append("name", name);
      formData.append("email", email);
      formData.append("password", password);
  
      fetch("/FINAL/Tecnologia/api/auth/register.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        mostrarMensaje(data.message, data.status);
      })
      .catch(error => {
        console.error("Error en la solicitud:", error);
        mostrarMensaje("Hubo un error, por favor intenta de nuevo.");
      });
    });
  }
  
  
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();
  
      const email = this.email.value.trim();
      const password = this.password.value.trim();
  
      if (!validarEmail(email)) return mostrarMensaje("Correo inválido");
  
      if (password.length < 6) return mostrarMensaje("Contraseña corta");
  
      const formData = new FormData(this);
      fetch("/FINAL/Tecnologia/api/auth/login.php", {
        method: "POST",
        body: formData
      })
        .then(r => r.json())
        .then(d => {
          mostrarMensaje(d.message, d.status);
          if (d.status === "success") {
            setTimeout(() => window.location.href = "dashboard.php", 1000);
          }
        });
    });
  }
  