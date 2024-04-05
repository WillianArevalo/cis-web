import { mostrarAlerta, validarFormulario, url } from "./funciones.js";
$(document).ready(function() {

    $("#tabla_proyectos").DataTable({
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

    $("#btn_agregar_proyecto").click(function() {
      validarFormulario("formulario_agregar_proyecto", enviarDatos)
    });

    function enviarDatos(){
      $.ajax({
         url: url + "proyectos/agregar",
         type: "POST",
         data: $("#formulario_agregar_proyecto").serialize(),
         success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            if (respuesta.status == "success") {
               $("#modal_agregar_proyecto").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            } else {
               $("#modal_agregar_proyecto").modal("hide");
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         }
      });
    }
    
    // Acciones desktop
   $(".btn_eliminar_proyecto").on("click", function() {
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
               url: url + "proyectos/eliminar",
               type: "POST",
               data: {id: id, _token:token},
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

   $(".btn_editar_proyecto").on("click", function(){
      var id = $(this).data("id");
      $.ajax({
         url: url + "proyectos/obtener_proyecto",
         type: "POST",
         data: {
            id:id
         },
         success: function(respuesta) {
            var response = JSON.parse(respuesta);
            if(response.status=="success"){
                  console.log(response);
                  $('#modal_editar_proyecto').modal('show');
                  $("#id_proyecto_editar").val(response.proyecto.id);
                  $("#comunidad_editar").val(response.proyecto.id_comunidad);
                  $("#nombre_proyecto_editar").val(response.proyecto.nombre_proyecto);
            }
            else{
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         },
         error: function() {
            mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
         }
      });
   });

   // Acciones mobile
   $("#proyectos-list").on("click",".btn_eliminar_proyecto", function() {
      var id = $(this).data('id');
      var token = $(this).data('token');
      Swal.fire({
         title:"¿Estás seguro? Esta acción no se puede deshacer.",
         text: "¡No podrás revertir esto!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#28a745",
         cancelButtonColor: "#dc3545",
         confirmButtonText: '<i class="fa-regular fa-trash-can me-1"></i>Sí, eliminar',
         cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
      }).then((result) => {
         if (result.value) {
            $.ajax({
               url: url + "proyectos/eliminar",
               type: "POST",
               data: {id: id, _token:token},
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

   $("#proyectos-list").on("click",".btn_editar_proyecto" ,function(){
      var id = $(this).data("id");
      $.ajax({
         url: url + "proyectos/obtener_proyecto",
         type: "POST",
         data: {
            id:id
         },
         success: function(respuesta) {
            var response = JSON.parse(respuesta);
            if(response.status=="success"){
                  $('#modal_editar_proyecto').modal('show');
                  $("#id_proyecto_editar").val(response.proyecto.id);
                  $("#comunidad_editar").val(response.proyecto.id_comunidad);
                  $("#nombre_proyecto_editar").val(response.proyecto.nombre_proyecto);
            }
            else{
               mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
            }
         },
         error: function() {
            mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
         }
      });
   });

   // Validacion y envio de datos
   $("#btn_editar_proyecto").click(function() {
      validarFormulario("formulario_editar_proyecto", enviarDatosEditar)
   });

   function enviarDatosEditar(){
   $.ajax({
      url: url + "proyectos/editar",
      type: "POST",
      data: $("#formulario_editar_proyecto").serialize(),
      success: function(respuesta) {
         var respuesta = JSON.parse(respuesta);
         if (respuesta.status == "success") {
            $('#modal_editar_proyecto').modal('hide');
            mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
         } else {
            $('#modal_editar_proyecto').modal('hide');
            mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
         }
      }
   });
   }

   $("#btn_asignar_becados").click(function() {
      var token = $(this).data('token');
      const cards = document.querySelectorAll('#column1 .card');
      const ids =[];
      cards.forEach(
         card => {
            const cardId = card.getAttribute('data-id');
            ids.push(cardId);
         }
      );
      console.log(ids);
      if(ids){
         var id_proyecto = $("#id_proyecto").val();   
         Swal.fire({
            title:"¿Estás seguro?",
            text:"Los becados seleccionados serán asignados al proyecto",
            icon:"warning",
            showCancelButton:true,
            confirmButtonColor:"#28a745",
            cancelButtonColor:"#dc3545",
            confirmButtonText:'<i class="fas fa-check"></i> Sí, asignar',
            cancelButtonText:'<i class="fas fa-times"></i> Cancelar'
         }).then((result)=>{
            if(result.value){
               $.ajax({
                  url: url + "proyectos/asignar_becados",
                  type:"POST",
                  data:{
                     id_proyecto:id_proyecto,
                     ids:ids,
                     _token:token
                  },
                  success:function(respuesta){
                     var respuesta = JSON.parse(respuesta);
                     if(respuesta.status=="success"){
                        mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                     }
                     else{
                        mostrarAlerta(respuesta.title, respuesta.message, respuesta.status, respuesta.url);
                     }
                  }
               });
            }
         });
      }   

   });

   $("#buscar-proyecto").on("input", function(){
      var nombre = $("#buscar-proyecto").val();
      $.ajax({
         url: url + "proyectos/buscar_proyecto",
         type: "POST",
         data:{
            nombre:nombre
         },
         success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            if (respuesta.status == "success") {
               console.log(respuesta.proyecto);
               $("#proyectos-list").html(respuesta.html);
            } else {
               $("#proyectos-list").html(respuesta.html);
            }
         }
      });
   })

});
