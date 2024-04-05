import { mostrarAlerta, validarFormulario, url  } from './funciones.js';

document.addEventListener('DOMContentLoaded', function() {

   let selectedImages = [];

   FilePond.registerPlugin(FilePondPluginImagePreview);
   const imageReportEdit = document.querySelector('input[id="image-report"]');
   const pond = FilePond.create(imageReportEdit, {
       labelIdle: 'Arrastra y suelta tus archivos o <span class="filepond--label-action">examinar</span>',
       imagePreviewHeight: 250, // Altura de la vista previa de la imagen
       imagePreviewWidth: 250, // Ancho de la vista previa de la imagen
       allowImagePreview: true, // Permitir vista previa de la imagen 
   });

  const filesImages = pond.getFiles();

   //Validar reporte


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
  $('#tema_actividad, #numero_participantes, #descripcion_reporte, #obstaculos_reporte').on('input', function() {
      var input = $(this);
      var minLength = parseInt(input.attr('data-min-caracteres'));
      validarCampo(input, minLength);
  });

  // Validar el formulario antes de enviarlo
  $('#btn_enviar_reporte').click(function() {
      var temaValido = validarCampo($('#tema_actividad'), parseInt($('#tema_actividad').attr('data-min-caracteres')));
      var participantesValido = validarCampo($('#numero_participantes'), parseInt($('#numero_participantes').attr('data-min-caracteres')));
      var descripcionValida = validarCampo($('#descripcion_reporte'), parseInt($('#descripcion_reporte').attr('data-min-caracteres')));
      var obstaculosValidos = validarCampo($('#obstaculos_reporte'), parseInt($('#obstaculos_reporte').attr('data-min-caracteres')));

      // Si todos los campos son válidos, enviar el formulario
      if (temaValido && participantesValido && descripcionValida && obstaculosValidos) {
         let images = pond.getFiles(); 
         if(images && images.length > 0){
            enviarDatos();
         }else{
            mostrarAlerta("¡Reporte sin imágenes!","Debes agregar al menos una imagen para tu reporte","warning");
         }
      } else {
         mostrarAlerta("¡Reporte no enviado!","Debes completar los campos requeridos","error");
      }
  });

   function enviarDatos(){
      var formData = new FormData($("#formulario_enviar_reporte")[0]);
      let files = pond.getFiles();
      for (let file of files) {
         formData.append('imagenes_reportes[]', file.file);
      }
   
      $.ajax({
            url: url + "reportes/enviar_reporte",
            type: "POST",
            data:formData,
            contentType: false,
            processData: false,
            success: function(respuesta) {
               var respuesta = JSON.parse(respuesta);
               if (respuesta.status == "success") {
                  mostrarAlerta(respuesta.title,respuesta.message, respuesta.status,  respuesta.url);
               } else {
                  mostrarAlerta(respuesta.title, respuesta.message, respuesta.status);
               }
            }
      });
   }

   $(".btn-eliminar-reporte").click(function() {
      var id = $(this).attr("data-id");
      var token = $(this).attr("data-token");
      Swal.fire({
         title: "¿Estás seguro? Esta acción no se puede deshacer.",
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
               url: url + "reportes/eliminar",
               type: "POST",
               data: {
                  id: id,
                  _token: token
               },
               success: function(respuesta) {
                  var respuesta = JSON.parse(respuesta);
                  if (respuesta.status == "success") {
                     mostrarAlerta(respuesta.title,respuesta.message, respuesta.status,  respuesta.url);
                  } else {
                     mostrarAlerta(respuesta.title,respuesta.message, respuesta.status,  respuesta.url);
                  }
               }
            });
         }
      });
   });

   $("#imagenes").on("click",".btn-eliminar-imagen",function() {
      var token = $("#token").val();
      Swal.fire({
      title: "¿Estás seguro de eliminar la imagen?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#dc3545",
      cancelButtonColor: "#28a745",
      confirmButtonText: '<i class="fa-regular fa-trash-can me-1"></i>Sí, eliminar',
      cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
      buttonsStyling: false, // Desactiva el estilo predeterminado de los botones
      customClass: {
         confirmButton: 'btn btn-success', // Clase CSS para el botón de confirmación
         cancelButton: 'btn btn-danger'    // Clase CSS para el botón de cancelación
      }
      }).then((result) => {
         if (result.value) {
            var id = $(this).attr("data-id");
            $.ajax({
               url: url + "reportes/eliminar_imagen",
               type: "POST",
               data: {
                  id: id,
                  _token: token
               },
               success: function(respuesta) {
                  var respuesta = JSON.parse(respuesta);
                  if (respuesta.status == "success") {
                     mostrarAlerta(respuesta.title,respuesta.message, respuesta.status);
                     $("#imagenes").html(respuesta.html);
                  } else {
                     mostrarAlerta(respuesta.title,respuesta.message, respuesta.status);
                  }
               }
            });
         }
      })
   });

   $("#btn_editar_reporte").on("click",function() {
      editarDatos();
   });

   function editarDatos(){
      var formData = new FormData($("#formulario_editar_reporte")[0]);
      let files = pond.getFiles();
      for (let file of files) {
         formData.append('imagenes_reporte_editar[]', file.file);
      }
   
      $.ajax({
            url: url + "reportes/editar_reporte",
            type: "POST",
            data:formData,
            contentType: false,
            processData: false,
            success: function(respuesta) {
               var respuesta = JSON.parse(respuesta);
               if (respuesta.status == "success") {
                  mostrarAlerta(respuesta.title,respuesta.message, respuesta.status,  respuesta.url);
               } else {
                  mostrarAlerta(respuesta.title,respuesta.message, respuesta.status,  respuesta.url);
               }
            }
      });
   }
});




