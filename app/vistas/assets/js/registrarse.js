import { validarFormulario, mostrarAlerta, url } from "./funciones.js";

$(document).ready(function() {
    
    function validarCampo(input, minLength) {
        var valor = input.val().trim();
        if (valor === "") {
            input.addClass('is-invalid');
            input.next('.invalid-feedback').text('Campo requerido');
            return false;
        } else if (valor.length < minLength) {
            input.addClass('is-invalid');
            input.next('.invalid-feedback').text(`El campo debe tener al menos ${minLength} caracteres.`);
            return false;
        } else {
            var missingElements = [];
            if (!/(?=.*[A-Z])/.test(valor)) {
                missingElements.push("una letra mayúscula");
            }
            if (!/(?=.*[!@#$%^&*()_+])/.test(valor)) {
                missingElements.push("un carácter especial");
            }
            if (!/(?=.*[0-9])/.test(valor)) {
                missingElements.push("un número");
            }
            if (missingElements.length > 0) {
                input.addClass('is-invalid');
                input.next('.invalid-feedback').text(`La contraseña debe contener ${missingElements.join(" y ")}.`);
                return false;
            } else {
                input.removeClass('is-invalid').addClass('is-valid');
                input.next('.invalid-feedback').text('');
                return true;
            }
        }
    }
    
    $("#password, #confirm_password").on('input', function() {
        var input = $(this);
        var minLength = parseInt(input.attr('data-min-caracteres'));
        validarCampo(input, minLength); 
    })
 
    validarFormulario("formulario_registrarse", enviarDatos);
    function enviarDatos(){
        var password = validarCampo($("#password"), parseInt($("#password").attr('data-min-caracteres')));
        var confirm_password = validarCampo($("#confirm_password"), parseInt($("#confirm_password").attr('data-min-caracteres')));
        if ($("#password").val() != $("#confirm_password").val()) {
            mostrarAlerta("Error", "Las contraseñas no coinciden", "error");
            return false;
        }
        if(password && confirm_password){
            $.ajax({
                type: "POST",
                url: url + "registrarse/crear_usuario",
                data: $("#formulario_registrarse").serialize(),
                success: function(respuesta) {
                    var objResponse = JSON.parse(respuesta);
                    if(objResponse.status==="success"){
                    mostrarAlerta(objResponse.title, objResponse.message, objResponse.status, objResponse.url);
                    }else{
                    mostrarAlerta(objResponse.title, objResponse.message, objResponse.status, objResponse.url);
                    }
                }
            });
        }else{
            mostrarAlerta("Error", "Contraseñas inválidas", "error")
        }
    }
});