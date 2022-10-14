<?php
session_start();
include "../db/Conexion.php";
$conexion = new Conexion();

if (empty($_SESSION['active'])) {
    header('location: ../');
}
$usuario = $_SESSION['iduser'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRO VENTAS</title>

    <?php include "includes/scriptsUp.php" ?>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include "includes/navbar.php" ?>

        <!-- Contentido Wrapper-->
        <div class="content-wrapper">
            <!-- contenido-header -->
            <div class="content-header">
                <div class="container-fluid">

                    <!-- inicio de cuerpo de trabajo -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Formulario</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Registrar Venta</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contenido-header -->

            <section class="content">
                <!-- inicio cuerpo de trabajo -->
                <div class="container-fluid">

                    <div class=" mx-auto d-block border border-dark rounded col-md-12 mb-4">
                        <h2 class="mx-auto d-block mt-2 p-1 text-center">Registro de Ventas Cafeteria Konecta</h2>
                        <form action="" id="formIngresoVenta" class="needs-validation mt-4 p-2 " method="POST" novalidate>
                            <div class="form-row">


                                <div class="col-sm-12 text-center">
                                    <!-- <div class="form-group text-center">
                                        <a type="button" title="Agregar Filas" class="mr-2 font-weight-bold" onclick="agregarFila()"><i class="fas fa-plus-circle text-white"></i></a>
                                        <a type="button" title="Eliminar Filas" class="font-weight-bold" onclick="eliminarFila()"><i class="fas fa-minus-circle text-white"></i></a>
                                    </div> -->
                                    <table class="table table-striped table-dark rounded table-sm" id="tablaeditarprueba" width="1000px" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">ID</th>
                                                <th scope="col" width="200px">Referencia</th>
                                                <th scope="col">Nombre Producto</th>
                                                <th scope="col">Peso</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col" width="80px">Cantidad</th>
                                                <th scope="col" width="100px">Precio</th>
                                                <th scope="col" width="100px">Total</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="id_1">
                                                <td style="display: none;">1</td>
                                                <td><input type="text" id="referencia_1" name="referencia[]" class="form-control" onblur="buscarProducto(1)" required> <input type="hidden" id="idProducto_1" name="idProducto[]"> <input type="hidden" id="stockVal_1" name="stock[]"></td>
                                                <td><span id="nombreProducto_1"></span></td>
                                                <td><span id="peso_1"></span></td>
                                                <td><span id="stock_1"></span></td>
                                                <td><input type="text" id="cantidad_1" value="0" name="cantidad[]" class="form-control" oninput="calcular(1)" onchange="agregarFila();" required></td>
                                                <td>$<span id="precio_1"></span></td>
                                                <th id="total_1">0</th>
                                                <td><a type="button" title="Eliminar Item" class="font-weight-bold" onclick="confirmarEliminar(this)"><i class="fas fa-minus-circle text-white"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="float-right d-none d-sm-inline-block">
                                        <div class="row mr-4">

                                            <div class="col-4 font-weight-bold">Total cantidad</div>
                                            <div class="col-5 font-weight-bold">Total precio</div>
                                        </div>
                                        <div class="row mr-4">

                                            <div class="col-5"><span id="totalCantidad">0</span></div>
                                            <div class="col-5"><span id="totalPrecio">0</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center mx-auto">

                                <div class="justify-content-center">
                                    <div class="text-center">

                                        <button type="submit" class="btn btn-dark mt-3" name="botonRegistro" id="botonRegistro">Registrar Venta</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- fin cuerpo de trabajo -->
            </section>
        </div>
        <!-- fin contenido-wrapper -->
        <!-- Main Footer -->
        <?php /* include "includes/footer.php"  */ ?>

    </div>
    <!-- fin wrapper -->
    <?php include "includes/scriptsDown.php" ?>

    <script>
        var btnDelItem;

        function agregarFila() {
            var table = document.getElementById("tablaeditarprueba");
            var rowCount = table.rows.length;
            min = Math.ceil(2);
            max = Math.floor(1000000);
            let random = Math.floor(Math.random() * (max - min) + min);            
            document.getElementById("tablaeditarprueba").insertRow(-1).innerHTML = `
                <tr id="id_${random}">
                    <td style="display: none;">${random}</td>
                    <td><input type="text" id="referencia_${random}" name="referencia[]" class="form-control" onchange="buscarProducto(${random})"> <input type="hidden" id="idProducto_${random}" name="idProducto[]"> <input type="hidden" id="stockVal_${random}" name="stock[]"></td>
                    <td><span id="nombreProducto_${random}"></span></td>
                    <td><span id="peso_${random}"></span></td>
                    <td><span id="stock_${random}"></span></td>
                    <td><input type="text" id="cantidad_${random}" name="cantidad[]" value="0"  oninput="calcular(${random})" onchange="agregarFila();" class="form-control" ></td>
                    <td>$<span id="precio_${random}"></span></td>
                    <th id="total_${random}">0</th>
                    <td><a type="button" title="Eliminar Item" class="font-weight-bold" onclick="confirmarEliminar(this)"><i class="fas fa-minus-circle text-white"></i></a></td>
                </tr>`;

        }


        function confirmarEliminar(ctrl) {
            btnDelItem = ctrl;
            Swal.fire({
                title: 'Desea Eliminar este item?',
                showCancelButton: true,
                confirmButtonText: 'Si',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    eliminarItem();
                }
            })
        }

        function eliminarItem() {
            btnDelItem.parentNode.parentNode.remove();

        }


        function buscarProducto(item) {

            const referencia = $(`#referencia_${item}`).val();
            if (referencia == '') {
                // $(`#referencia_${item}`).focus();
                return Toast.fire({
                    icon: 'warning',
                    title: 'No se ha ingresado ninguna referencia'
                });
            }
            $.ajax({
                type: "POST",
                url: "php/buscarProducto.php",
                data: {
                    referencia
                },
                dataType: "json",
                success: function(resp) {
                    console.log();
                    const {
                        id_producto,
                        nombre_producto,
                        stock,
                        precio,
                        peso,
                    } = resp
                    $(`#nombreProducto_${item}`).html(nombre_producto);
                    $(`#stock_${item}`).html(stock);
                    $(`#precio_${item}`).html(precio);
                    $(`#peso_${item}`).html(peso);
                    $(`#idProducto_${item}`).val(id_producto);
                    $(`#stockVal_${item}`).val(stock);
                    

                },
                error: function(error) {

                    $(`#referencia_${item}`).val('').focus();
                    Toast.fire({
                        icon: 'error',
                        title: 'El producto no existe'
                    });
                }
            });
        }


        function calcular(id=0) {
            const stock = ($(`#stock_${id}`).html());
            let cantidad = parseInt($(`#cantidad_${id}`).val());
            if(cantidad>stock){
                cantidad = 0
                $(`#cantidad_${id}`).val(0)
                return Toast.fire({
                            icon: 'warning',
                            title: 'La cantidad ingresada no puede ser mayor al stock disponible'
                        });
            }
            const precio = parseInt($(`#precio_${id}`).html());

            const total  = cantidad * precio;
            
            $(`#total_${id}`).html(total);

            var r = $("#tablaeditarprueba tbody:eq(0) tr");
            let totalCantidad = 0;
            let totalPrecio = 0;
            for (let i = 0; i < r.length; i++) {
                const idFor = parseInt(r[i].cells[0].innerHTML);
                const sum = parseInt(r[i].cells[7].innerHTML);
                const cant = parseInt($(`#cantidad_${idFor}`).val());
                totalCantidad += cant
                totalPrecio += sum;
            }            
            $('#totalCantidad').html(totalCantidad);
            $('#totalPrecio').html(totalPrecio);
        }
    </script>

    <script>
        $(function() {            
            $(document).on('submit', '#formIngresoVenta', function() {
                const data = $('#formIngresoVenta').serialize();
                console.log(data);
                $.ajax({
                    url: "php/registrarVenta.php",
                    method: "POST",
                    data: $('#formIngresoVenta').serialize(),                   
                    // dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {                            
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                html: '<img src="../img/konecta-logo.svg">',
                                title: '<br>Entrega de Satisfacción Registrada Corectamente',
                                background: ' #000000cd',
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {
                                window.location = "";
                            })
                        }

                    },
                    error: function(error){
                        console.log(error);
                    }
                });

            });



        });
    </script>

</body>

</html>