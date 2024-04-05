import { mostrarAlerta, url } from "./funciones.js";

$(document).ready(function() {

    function validarCampo(input, minLength) {
        var valor = input.val().trim();
        if (valor === "") {
            input.addClass('is-invalid');
            input.next('.invalid-feedback').text('Campo requerido');
            return false;
        } else {
            var caracteresRestantes = minLength - valor.length;
            if (valor.length < minLength) {
                input.addClass('is-invalid');
                input.next('.invalid-feedback').text(`El campo debe tener al menos ${minLength} caracteres. Faltan ${caracteresRestantes} caracteres.`);
                return false;
            } else {
                input.removeClass('is-invalid').addClass('is-valid');
                input.next('.invalid-feedback').text('');
                return true;
            }
        }
    }

     // Escucha de eventos para validar los campos cuando se ingresa texto
  $('#password, #confirmed_password').on('input', function() {
    var input = $(this);
    var minLength = parseInt(input.attr('data-min-caracteres'));
    validarCampo(input, minLength);
  });

// Validar el formulario antes de enviarlo
    $('#cambiar_contraseña').click(function() {
        var password = $('#password').val();
        var confirmed_password = $('#confirmed_password').val();
        var passwordValido = validarCampo($('#password'), parseInt($('#password').attr('data-min-caracteres')));
        var confirmedPasswordValido = validarCampo($('#confirmed_password'), parseInt($('#confirmed_password').attr('data-min-caracteres')));
        // Si todos los campos son válidos, enviar el formulario
        if (passwordValido && confirmedPasswordValido) {
            if(password===confirmed_password){
                enviarDatos();
            }else{
                mostrarAlerta("¡Contraseñas no coinciden!", "Las contraseñas no coinciden", "error");
            }
        }
    });

    function enviarDatos(){
        var password = $("#password").val();
        var token =  $("#token").val();
        Swal.fire({
            title: 'Ingrese su contraseña actual:',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            showLoaderOnConfirm: true,
            preConfirm: (contraseña) => {
                return $.ajax({
                    url: url + "usuarios/cambiar_clave",
                    method: 'POST',
                    data: {
                        password: contraseña,
                        new_password: password,
                        _token: token,
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status === 'success') {
                            Swal.fire(
                                'Contraseña cambiada',
                                'Tu contraseña ha sido cambiada con éxito',
                                'success'
                            ).then(
                                function() {
                                    location.reload();
                                }
                            );
                        } else {
                            Swal.showValidationMessage(response.message);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.showValidationMessage(
                            `Error: ${textStatus}`
                        );
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    $('#cambiar_correo').click(function(){
        var email = $("#email").val();
        var token = $(this).attr("data-token");
        Swal.fire({
            title: 'Ingrese su contraseña actual:',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            showLoaderOnConfirm: true,
            preConfirm: (contraseña) => {
                return $.ajax({
                    url:  url + "perfil/cambiar_correo",
                    method: 'POST',
                    data: {
                        password: contraseña,
                        email: email,
                        _token: token
                       },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status === 'success') {
                            Swal.fire(
                                'Correo cambiado',
                                'Su correo ha sido cambiado con exito, se cerrara la sesion para que inicie con su nuevo correo',
                                'success'
                            ).then(
                                function() {
                                    location.href = url + "login/logout";
                                }
                            );
                        } else {
                            Swal.showValidationMessage(response.message);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.showValidationMessage(
                            `Error: ${textStatus}`
                        );
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });

});