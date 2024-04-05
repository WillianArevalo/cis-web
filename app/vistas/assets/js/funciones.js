var url = "http://localhost/cis-web/";

/**
 * 
 * @param {*} formularioId 
 * @param {*} enviarDatos 
 */
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


/**
 * Funcion mostrarAlerta
 * @param {string} msg - Mensaje a mostrar
 * @param {string} status - Estado de la alerta
 * @returns {void}
 * @description Muestra una alerta en la página
 * @example mostrarAlerta("El usuario se ha agregado correctamente", "success");
 */
function mostrarAlerta(title, msg, status, location = null) {
    Swal.fire({
         title:title,
         text:msg,
         icon:status,    
         showCancelButton:false,
         showConfirmButton:true,
         confirmButtonText:"<i class='fa-regular fa-circle-check me-1'></i>Aceptar",
         confirmButtonColor:"#28a745"
    }).then((result)=>{
        if(result.value){
            if(location){
                window.location.href = url + location;
            }
        }
    })
}

export { validarFormulario, mostrarAlerta, url};