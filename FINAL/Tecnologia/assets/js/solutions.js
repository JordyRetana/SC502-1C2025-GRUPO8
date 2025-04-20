document.getElementById('infoForm').addEventListener('submit', function (e) {
    e.preventDefault();
  
    var name = document.getElementById('name').value.trim();
    var comment = document.getElementById('comment').value.trim();
    var phone = document.getElementById('phone').value.trim();
  
    if (!name || !comment || !phone) {
      alert('Por favor, completa todos los campos.');
      return;
    }
  
    var formData = new FormData();
    formData.append('name', name);
    formData.append('comment', comment);
    formData.append('phone', phone);
  
    fetch('/FINAL/Tecnologia/api/send_email.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la respuesta del servidor');
      }
      return response.json();
    })
    .then(data => {
      console.log('Respuesta JSON:', data);
      if (data.success) {
        alert('¡Gracias! Tu información ha sido enviada.');
        $('#infoModal').modal('hide');
        document.getElementById('infoForm').reset();
      } else {
        alert('Hubo un error al enviar la información. Inténtalo nuevamente.');
      }
    })
    .catch(error => {
      console.error('Error al enviar:', error);
      alert('Ocurrió un error inesperado. Intenta más tarde.');
    });
  });
  