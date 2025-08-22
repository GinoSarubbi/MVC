const emailInput = document.getElementById("emailRegistro");
if (emailInput) {
    emailInput.addEventListener("change", function () {
        // eliminar alertas previas
        const alertas = document.querySelectorAll(".alert"); 
        alertas.forEach(function (alerta) {
            alerta.remove();
        });

        // obtener el valor del input
        let email = this.value;
        let datos = new FormData();
        datos.append("validarEmail", email);

        // enviar la petición
        fetch('./app/ajax/formularios.ajax.php', {
            method: "POST",
            body: datos,
        })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                if (respuesta) {
                    // limpiar input
                    document.getElementById('emailRegistro').value = '';

                    // crear alerta de Bootstrap
                    const alerta = document.createElement('div');
                    alerta.className = "alert alert-danger py-2";
                    alerta.innerHTML = `El email ya está registrado`;

                    document.getElementById("alerta").parentNode.insertAdjacentElement('afterend', alerta);
                }
            })
            .catch(error => {
                console.error('Error al validar el email:', error);
            });
    });
}
