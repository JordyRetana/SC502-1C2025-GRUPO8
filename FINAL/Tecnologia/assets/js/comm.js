const botones = document.querySelectorAll('[data-bs-toggle="modal"]');
const modal = new bootstrap.Modal(document.getElementById('registroModal'));

botones.forEach(button => {
    button.addEventListener('click', () => {
        modal.show();
    });
});

document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const comentarios = document.getElementById('comentarios').value;

    if (!nombre || !correo || !comentarios) {
        alert('Por favor, rellena todos los campos.');
        return;
    }

    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('correo', correo);
    formData.append('comentarios', comentarios);

    fetch('/FINAL/Tecnologia/api/enviar_registro.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes('Mensaje enviado exitosamente')) {
            alert('¡Gracias por registrarte!');
            modal.hide(); 
            document.getElementById('registroForm').reset(); 
        } else {
            alert('Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.');
        }
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
        alert('Hubo un error al enviar el mensaje.');
    });
});
