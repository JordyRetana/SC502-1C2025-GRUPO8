$(document).ready(function () {
    document.querySelectorAll('.open-subscribe-modal').forEach(btn => {
        btn.addEventListener('click', function () {
            const plan = this.getAttribute('data-plan');
            document.getElementById('planSeleccionado').value = plan;
            document.getElementById('terms-step').style.display = 'block';
            document.getElementById('form-step').style.display = 'none';
        });
    });

    document.getElementById('acceptTerms').addEventListener('click', () => {
        document.getElementById('terms-step').style.display = 'none';
        const formStep = document.getElementById('form-step');
        formStep.style.display = 'block';
        formStep.removeAttribute("style");
    });

    $("#subscribeForm").on("submit", function (e) {
        e.preventDefault(); 

        var loadingMessage = $("<div class='alert alert-info text-center'>Guardando suscripción...</div>");
        $("body").append(loadingMessage);

        var formData = $(this).serialize();

        $.ajax({
            url: "../api/suscripcion/guardar_suscripcion.php",
            type: "POST",
            data: formData,
            success: function (response) {
                const data = typeof response === "string" ? JSON.parse(response) : response;
                loadingMessage.remove();

                if (data.success) {
                    $.ajax({
                        url: "../api/suscripcion/registrar_suscripcion.php",
                        type: "POST",
                        data: formData,
                        success: function (correoResponse) {
                            const correoData = typeof correoResponse === "string" ? JSON.parse(correoResponse) : correoResponse;

                            if (correoData.success) {
                                alert("¡Gracias por suscribirte! Te enviaremos un correo.");
                                $('#subscribeForm')[0].reset();
                                const modal = bootstrap.Modal.getInstance(document.getElementById('subscribeModal'));
                                modal.hide();
                            } else {
                                alert("Suscripción guardada, pero falló el envío del correo: " + correoData.message);
                            }
                        },
                        error: function () {
                            alert("Suscripción guardada, pero ocurrió un error al enviar el correo.");
                        }
                    });
                } else {
                    alert("Error al guardar la suscripción: " + data.message);
                }
            },
            error: function () {
                loadingMessage.remove();
                alert("Hubo un error al procesar la suscripción.");
            }
        });
    });
});
