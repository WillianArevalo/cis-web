
function validarFormulario(formularioId, enviarDatos){
    "use strict";
    const form = document.getElementById(formularioId);

    if (form) {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault();
                enviarDatos();
            }

            form.classList.add('was-validated');
        }, false);
    }
}

$(document).ready(function() {

    validarFormulario("formulario_recuperar", enviarDatos);

    function enviarDatos(){
        
    }
});