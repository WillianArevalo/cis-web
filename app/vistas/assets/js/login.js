import { validarFormulario, mostrarAlerta, url } from "./funciones.js";

$(document).ready(function() {
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      validarFormulario("formulario_login", enviarDatos);

      function enviarDatos(){
          $.ajax({
              type: "POST",
              url: url + "login/validar_usuario",
              data: $("#formulario_login").serialize(),
              success: function(respuesta) {
                  var objResponse = JSON.parse(respuesta);
                  if(objResponse.status==="success"){
                      if(objResponse.usuario.rol==="admin"){
                            mostrarAlerta(objResponse.title, objResponse.message, objResponse.status);
                            setTimeout(function(){
                                window.location.href = url + "dashboard";
                            }, 2000);
                      }else if(objResponse.usuario.rol==="becado"){
                            mostrarAlerta(objResponse.title, objResponse.message, objResponse.status);
                            setTimeout(function(){
                                window.location.href = url + "inicio";
                            }, 2000);
                      }else{
                         mostrarAlerta(objResponse.title, objResponse.message, objResponse.status);
                      }
                  }else{
                        mostrarAlerta(objResponse.title, objResponse.message, objResponse.status);
                  }
              }
          });
      }
});



