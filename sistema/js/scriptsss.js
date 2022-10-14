$(document).ready(function () {

    /* SELECT2 */

    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

});


// Validar formularios
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


/* USUARIOS */

function formEditarusuario(datos) {
    d = datos.split('||');
    $(".idUsuario").val(d[0]);
    $(".nombre").val(d[1]);
    $(".cargo").val(d[2]);
    $(".area").val(d[3]);
    $(".usuario").val(d[4]);
    $(".clave").val(d[5]);
    $(".correo").val(d[6]);
    $('#modalEditarUsuario').modal('show');
}

function registrarUsuario() {
    $.ajax({
        type: "POST",
        url: "php/registrarUsuario.php",
        data: $('#registrarUsuario').serialize(),
        dataType: "json",
        success: function (d) {
            if (d == 1) {
                $('#modalRegistrarUsuario').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Usuario Ingresado Correctamente',

                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Error al Intentar Ingresar Usuario',

                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        }
    });
}

function editarUsuario() {
    $.ajax({
        type: "POST",
        url: "php/editarUsuario.php",
        data: $('#editarUsuario').serialize(),
        dataType: "json",
        success: function (d) {
            if (d == 1) {
                $('#modalEditarUsuario').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Usuario Editado Correctamente',

                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Error al Intentar Editar Usuario',

                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        }
    });
}


/* PRODUCTOS */

function registrarProducto() {
    $.ajax({
        type: "POST",
        url: "php/registrarProducto.php",
        data: $('#registrarProducto').serialize(),
        dataType: "json",
        success: function (d) {
            if (d == 1) {
                $('#modalRegistrarProducto').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Producto Ingresado Correctamente',
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Error al Intentar Ingresar Producto',
                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        }
    });
}

function formEditarProducto(datos) {
    console.log(datos);
    d = datos.split('||');
    $(".idProducto").val(d[0]);
    $(".idProducto").html(d[0]);
    $(".referencia").val(d[1]);
    $(".nombreProducto").val(d[2]);
    $(".precio").val(d[3]);
    $(".peso").val(d[4]);
    $(".categoria").val(d[5]);
    $(".stock").val(d[6]);
    $(".estado").val(d[7]);
    $('#modalEditarProducto').modal('show');
}

function editarProducto() {
    $.ajax({
        type: "POST",
        url: "php/editarProducto.php",
        data: $('#editarProducto').serialize(),
        success: function (d) {
            console.log(d);
            if (d == 1) {
                $('#modalEditarProducto').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Producto Editado Correctamente',

                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    window.location = "";
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<img src="../img/konecta-logo.svg">',
                    title: '<br>Error al Intentar Editar Producto',

                    showConfirmButton: false,
                    timer: 2000,
                })
            }
        },
        error:(error)=>{
            console.log(error);
        }
    });
}
