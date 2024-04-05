import { mostrarAlerta, validarFormulario, url } from "./funciones.js";

$(document).ready(function() {

    $("#tabla_usuarios").DataTable({
        "pageLength": 5,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    $("#btn_agregar_usuario").click(function() {
         validarFormulario("formulario_agregar_usuario", enviarDatos);    
    });

    function enviarDatos(){
      $.ajax({
         url: url + "usuarios/agregar",
         type: "POST",
         data: $("#formulario_agregar_usuario").serialize(),
         success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            if (respuesta.status == "success") {
               $("#modal_agregar_becado").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            } else {
               $("#modal_agregar_becado").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         }
      });
    }


    $("#tabla_usuarios").on("click", ".btn_eliminar_usuario", function() {
         var id = $(this).data('id');
         var token = $(this).data('token');
         Swal.fire({
            title:"¿Estás seguro? Esta acción no se puede deshacer.",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#28a745",
            confirmButtonText: '<i class="fa-regular fa-trash-can me-1"></i>Sí, eliminar',
            cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
         }).then((result) => {
            if (result.value) {
               $.ajax({
                  url: url + "usuarios/eliminar",
                  type: "POST",
                  data: {id: id, _token: token},
                  success: function(respuesta) {
                     var respuesta = JSON.parse(respuesta);
                     if (respuesta.status == "success") {
                        mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                     } else {
                        mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                     }
                  }
               });
            }
         });
    });

    $(".btn_editar_usuario").on("click", function() {
         var id = $(this).data('id');
         $.ajax({
            url: url + "usuarios/editar",
            type: "POST",
            data: {id: id},
            success: function(respuesta) {
               var respuesta = JSON.parse(respuesta);
               if (respuesta.status == "success") {
                  $("#id_usuario").val(respuesta.usuario.id);
                  $("#nombres_usuario").val(respuesta.usuario.nombres);
                  $("#apellidos_usuario").val(respuesta.usuario.apellidos);
                  $("#email_usuario").val(respuesta.usuario.email);
                  $("#usuario").val(respuesta.usuario.usuario);
                  $("#rol_usuario").val(respuesta.usuario.rol);
                  console.log(respuesta.usuario);
                  $("#modal_editar_usuario").modal("show");
               } else {
                  $("#modal_editar_usuario").modal("hide");
                  mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
               }
            }
         });
    });

    $("#tabla_usuarios").on("click", ".btn_editar_usuario", function() {
      var id = $(this).data('id');
      $.ajax({
         url: url + "usuarios/editar",
         type: "POST",
         data: {id: id},
         success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            if (respuesta.status == "success") {
               $("#id_usuario").val(respuesta.usuario.id);
               $("#nombres_usuario").val(respuesta.usuario.nombres);
               $("#apellidos_usuario").val(respuesta.usuario.apellidos);
               $("#email_usuario").val(respuesta.usuario.email);
               $("#usuario").val(respuesta.usuario.usuario);
               $("#rol_usuario").val(respuesta.usuario.rol);
               console.log(respuesta.usuario);
               $("#modal_editar_usuario").modal("show");
            } else {
               $("#modal_editar_usuario").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         }
      });
 });


    $("#btn_editar_usuario").on("click", function(){
      validarFormulario("formulario_editar_usuario", editarUsuario);
    });

    function editarUsuario(){
      $.ajax({
         url: url + "usuarios/actualizar",
         type: "POST",
         data: $("#formulario_editar_usuario").serialize(),
         success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            if (respuesta.status == "success") {
               $("#modal_editar_usuario").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            } else {
               $("#modal_editar_usuario").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         }
      });
    }

});
