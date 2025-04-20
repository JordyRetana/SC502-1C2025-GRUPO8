const errorMessages = {
    'invalid_credentials': 'Correo o contraseña incorrectos',
    'user_not_found': 'Usuario no encontrado',
    'email_exists': 'Este correo ya está registrado',
    'validation_error': 'Por favor completa todos los campos correctamente',
    'email_not_subscribed': 'Correo no encontrado en la lista de suscripciones',
    'password_mismatch': 'Las contraseñas no coinciden',
    'user_already_registered': 'Usuario conectado al plan de suscripción. Espere que el host le dé acceso a su página.'
};

const Auth = {
    alertShown: false,  

    register: async function(userData) {
        try {
            const response = await fetch('/FINAL/Plataforma/api/auth/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(userData)
            });

            const text = await response.text();
            console.log('Respuesta del servidor:', text);

            const data = JSON.parse(text);

            if (!data.success) {
                const handled = this.handleAuthErrors(data);
                return data;
            }

            if (!this.alertShown) {
                this.showAuthAlertDark("Inicio de sesión activo. Espere que el host le active el dashboard correspondiente.");
                this.showAuthSuccess("Registro exitoso! Espere a que el host le dé acceso.");
                this.alertShown = true;  
            }

            return data;
        } catch (error) {
            console.error('Error en Auth.register:', error);
            return { success: false, error: 'Error de conexión' };
        }
    },

    handleAuthErrors: function(response) {
        if (!response.success) {
            if (response.error === 'user_already_registered') {
                if (!this.alertShown) {
                    this.showAuthAlertDark("Inicio de sesión activo. Espere que el host le active el dashboard correspondiente.");
                    this.alertShown = true; 
                }
                return true;
            }

            const message = errorMessages[response.error] || response.error || 'Error desconocido';
            this.showAuthError(message);
            return true;
        }
        return false;
    },

    showAuthError: function(message) {
        const errorElement = document.getElementById('authError') || document.createElement('div');

        if (!document.getElementById('authError')) {
            errorElement.id = 'authError';
            errorElement.className = 'alert alert-danger';
            errorElement.style.marginTop = '1rem';
            document.querySelector('form').appendChild(errorElement);
        }

        errorElement.textContent = message;
        errorElement.style.display = 'block';

        setTimeout(() => {
            errorElement.style.display = 'none';
        }, 5000);
    },

 
    showAuthAlertDark: function(message) {
        const darkAlert = document.createElement('div');
        darkAlert.className = 'alert alert-dark text-white text-center fw-bold';
        darkAlert.style.background = '#222';
        darkAlert.style.border = '1px solid #444';
        darkAlert.style.marginTop = '1rem';
        darkAlert.style.padding = '1rem';
        darkAlert.style.borderRadius = '0.5rem';
        darkAlert.style.boxShadow = '0 0 10px rgba(0,0,0,0.5)';
        darkAlert.textContent = message;

        document.querySelector('form').appendChild(darkAlert);

        setTimeout(() => {
            darkAlert.remove();
        }, 6000);
    },

    showAuthSuccess: function(message) {
        const successAlert = document.createElement('div');
        successAlert.className = 'alert alert-success text-white text-center fw-bold';
        successAlert.style.background = '#28a745';
        successAlert.style.border = '1px solid #218838';
        successAlert.style.marginTop = '1rem';
        successAlert.style.padding = '1rem';
        successAlert.style.borderRadius = '0.5rem';
        successAlert.style.boxShadow = '0 0 10px rgba(0,0,0,0.5)';
        successAlert.textContent = message;

        document.querySelector('form').appendChild(successAlert);

        setTimeout(() => {
            successAlert.remove();
        }, 6000);
    }
};

if (typeof module !== 'undefined' && module.exports) {
    module.exports = Auth;
} else {
    window.Auth = Auth;
}
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = {
        email: this.email.value,
        password: this.password.value
    };

    console.log(formData); 

    fetch('/FINAL/Plataforma/api/auth/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
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
