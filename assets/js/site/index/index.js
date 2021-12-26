"use strict";
const d = document,
    w = window;

d.addEventListener('DOMContentLoaded', function (e) {

    let $candidato_cards = d.getElementsByClassName('candidato'); // HTMLCollection

    let iterable_cards = Array.from($candidato_cards); // con Array.from() convertimos un HTMLcollection a array
    
    $candidato_cards && iterable_cards.forEach(element => {

        element.addEventListener('click', function (e) {

            e.stopPropagation();

            this.classList.add('selected');

            iterable_cards.forEach(element1 => {
                if(this!=element1) 
                    if(element1.classList.contains('selected')) element1.classList.remove('selected');
            });

        }, false); // flujo bubbble, que va desde el mas interno a mas exteno, o sea, del hijo al padre
    });

});

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
// });

function redirect(id) {
    window.location.href = "Eleccion.php?id=" + id;
}

