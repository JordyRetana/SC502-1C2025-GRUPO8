document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.contact-form');
    if (form) {
      form.addEventListener('submit', async function(e) {
        e.preventDefault();
  
        const formData = new FormData(this);
  
        try {
          const response = await fetch('../api/contacto/enviar_contacto.php', {
            method: 'POST',
            body: formData
          });
  
          const result = await response.json();
  
          if (result.success) {
            alert(result.message);
            this.reset();
          } else {
            alert(result.message);
          }
        } catch (error) {
          console.error('Error de red:', error);
          alert('Error al enviar el mensaje. Inténtalo nuevamente.');
        }
      });
    }
  });
  