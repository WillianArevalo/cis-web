import { url } from "./funciones.js";
$(document).ready(function(){

    $(".btn_cerrar_sesion").on("click",function(){
        Swal.fire({
            title:"¿Estás seguro de cerrar sesión?", 
            icon:"warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "<i class='fa-solid fa-right-from-bracket'></i> Cerrar sesión",
            cancelButtonText: "<i class='fa-solid fa-xmark'></i> Cancelar" 
        }).then((result)=>{
            if(result.value){
                window.location.href = url + "login/logout";
            }
        });
    });
})

