import { mostrarAlerta, validarFormulario, url } from "./funciones.js";

$(document).ready(function() {

    $("#tabla_becados").DataTable({
        "pageLength": 30,
        "paging": false,
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
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    $("#imagen-agregar").attr("src", url + "app/vistas/assets/images/sin_imagen.jpg");

    $(".btn_agregar_becado").click(function() {
       validarFormulario("formulario_agregar_becado", enviarDatos);
    });

    function enviarDatos(){
        var datos = new FormData($("#formulario_agregar_becado")[0]);
        $.ajax({
            url: url + "becados/agregar",
            type: "POST",
            data: datos,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                var respuesta = JSON.parse(respuesta);
                if(respuesta.status=="success"){
                    mostrarAlerta(respuesta.title, respuesta.message,respuesta.status, respuesta.url);
                }else{
                  mostrarAlerta(respuesta.title, respuesta.message,respuesta.status, respuesta.url);
                }
            }
        });
    }

    $(".btn_eliminar_becado").click(function(){
        var id = $(this).attr("data-id");
        var token = $(this).attr("data-token");
      Swal.fire({
         title: "¿Estás seguro? <br> Esta acción no se puede deshacer.",
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
               url: url + "becados/eliminar",
               type: "POST",
               data: {
                  id: id,
                  _token:token
               },
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

    $("#btn_editar_becado").click(function(){
        validarFormulario("formulario_editar_becado", editarDatos);
    });

    function editarDatos(){
        var datos = new FormData($("#formulario_editar_becado")[0]);
        console.log($("#formulario_editar_becado").serialize());
        $.ajax({
            url: url + "becados/actualizar",
            type: "POST",
            data: datos,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                var respuesta = JSON.parse(respuesta);
                console.log(respuesta);
                if(respuesta.status=="success"){
                  mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                }else{
                  mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                }
            },
            error: function(respuesta){
                console.log(respuesta);
            }
        });
    }

    $("#buscar-becado").on("input", function(){
        var nombre = $("#buscar-becado").val();
        $.ajax({
           url: url + "becados/buscar_becado",
           type: "POST",
           data:{
              nombre:nombre
           },
           success: function(respuesta) {
              var respuesta = JSON.parse(respuesta);
              if (respuesta.status == "success") {
                 $("#becados-list").html(respuesta.html);
              } else {
                 $("#becados-list").html(respuesta.html);
              }
           }
        });
     });


    $("#becados-list").on("click",".btn_eliminar_becado",function(){
        var id = $(this).attr("data-id");
      Swal.fire({
         title: "¿Estás seguro?<br> Esta acción no se puede deshacer.",
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
               url: url + "becados/eliminar",
               type: "POST",
               data: {
                  id: id
               },
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
    
});