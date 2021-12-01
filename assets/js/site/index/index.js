$(document).ready(function(){

   $(".candidato").click(function(){

        $(this).css({"background-color" : "#5f5a"});        

        let id = $(this).data("id");
        
        $("#votar").click(function(){
            
            redirect(id);
        });

    //     if(confirm("¿Está seguro que deseas eliminar este puesto?")){

    //         if(id !== null && id !== undefined && id !== "" ){
                     
    //           toastr["warning"]("Elemento será eleliminado", "Notifacation");

    //           let timer = setTimeout(function(){
    //               redirect(id);
    //           }, 3100);

    //         }        
    //     }
   });

//    $("p").click(function(){
//     alert("The paragraph was clicked.");
//   });

    // configuración del toastr.
    // toastr.options = {
    //     "closeButton": true,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": true,
    //     "positionClass": "toast-bottom-right",
    //     "preventDuplicates": false,
    //     "onclick": null,
    //     "showDuration": "200",
    //     "hideDuration": "1000",
    //     "timeOut": "3000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "swing",
    //     "showMethod": "show",
    //     "hideMethod": "fadeOut"
    // }
});

function redirect(id){
    window.location.href = "Eleccion.php?id=" + id;
}