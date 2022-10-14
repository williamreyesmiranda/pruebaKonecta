<?php
$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
session_start();
include "../db/Conexion.php";
$conexion = new Conexion();

if (empty($_SESSION['active'])) {
  header('location: ../');
}

$idEntrega = $_GET['id'];
$consultaSQL = "SELECT * FROM entregas ent 
INNER JOIN empresas empr ON empr.id_empresa=ent.empresa
INNER JOIN empleados empl ON empl.id_empleado=ent.empleado
INNER JOIN usuario us ON us.id_usuario=ent.usuario
INNER JOIN estado_entrega esen ON ent.estado_entrega=esen.id_estado
 WHERE ent.id_entrega='$idEntrega'";
$entrega = $conexion->consultarDatos($consultaSQL);
$firma_empleado = $entrega[0]['firma_empleado'];
$nombreEmpresa=$entrega[0]['nombre_empresa'];
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Entrega N°<?php echo ($idEntrega) ?>(<?php echo ($nombreEmpresa)?>)</title>

  <?php include "includes/scriptsUp.php" ?>
</head>
<style>
  #signatureparent {
    color: black;
    background-color: darkgrey;
    max-width: 380px;
    padding: 10px;
    border-radius: 6px;
  }

  #firma {
    border: 2px dotted black;
    background-color: lightgrey;
  }

  html.touch #content {
    float: left;
    width: 92%;
  }
</style>


<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php /* include "includes/navbar.php"  */ ?>

    <!-- Contentido Wrapper-->
    <div class="">
      <!-- contenido-header -->
      <div class="content-header">
        <div class="container-fluid">

          <!-- inicio de cuerpo de trabajo -->
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Reporte de la Entrega N°<?php echo ($idEntrega) ?></h1>
              <h1>Estado:<?php echo ($entrega[0]['nombre_estado']) ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <!-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Reporte Entrega</li>

                            </ol> -->
            </div>
          </div>
        </div>
      </div>
      <!-- contenido-header -->

      <section class="content">
        <!-- inicio cuerpo de trabajo -->
        <div class="">

          <div class="card bg-white text-dark mt-5">


            <div class="card-body">
              <div class="row">
                <div class="col-2"><img src="../img/konecta-negro.png" style="width:100%"></div>
                <div class="col-8 font-weight-bold text-center">
                  <h3>ENTREGA A SATISFACCIÓN DE PRODUCTOS Y/O SERVICIOS</h3>
                </div>
                <div class="col-2 border rounded font-weight-bold d-flex align-items-center"><span class="mx-auto">
                    <p>
                    <h3>Entrega N°<?php echo ($idEntrega) ?></h3>
                    </p>
                    <p><?php echo ($entrega[0]['fecha_ingreso']) ?></p>
                  </span> </div>
              </div>
              <hr>
              <div class="row">
                <div class="p-2 col-6 border rounded"><span class="font-weight-bold">Razón Social (Cliente): </span> <?php echo ($entrega[0]['nombre_empresa']) ?></div>
                <div class="p-2 col-6 border rounded"><span class="font-weight-bold">Nit: </span> <?php echo ($entrega[0]['nit_empresa']) ?></div>
              </div>
              <div class="row mt-2">
                <div class="p-2 col-6 border rounded"><span class="font-weight-bold">Quien Recibe: </span> <?php echo ($entrega[0]['nombre_empleado']) ?></div>
                <div class="p-2 col-6 border rounded"><span class="font-weight-bold">Cargo: </span> <?php echo ($entrega[0]['cargo_empleado']) ?></div>
              </div>
              <hr>
              <div class="col-12 ">
                <table class="table table-sm" width="100%">
                  <thead>
                    <tr class="text-center table-active">
                      <th style="width:50px">Item</th>
                      <th style="width:70px">Cant</th>
                      <th>Descripción</th>
                      <th>Marca</th>
                      <th>Serial</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $consultaSQL = "SELECT * FROM entregas_productos WHERE entrega=$idEntrega";
                    $productos = $conexion->consultarDatos($consultaSQL);
                    $contar = 1;
                    foreach ($productos as $producto) :
                    ?>
                      <tr class="text-center">
                        <td><?php echo ($contar) ?></td>
                        <td><?php echo ($producto['cantidad']) ?></td>
                        <td><?php echo ($producto['descripcion']) ?></td>
                        <td><?php echo ($producto['marca']) ?></td>
                        <td><?php echo ($producto['serial']) ?></td>
                      </tr>
                    <?php $contar++;
                    endforeach ?>
                  </tbody>
                </table>
              </div>
              <hr>
              <div class="p-2 mt-3 col-12 border rounded">
                <span class="font-weight-bold">Observaciones:</span>
                <hr> <?php echo ($entrega[0]['observaciones']) ?>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6 text-center ">
                  <div><span><?php echo ($entrega[0]['firma_empleado']) ?></span></div>
                  <div><?php echo ($entrega[0]['nombre_empleado'])?><br>(<?php echo ($entrega[0]['cargo_empleado']) ?>)</div>
                </div>
                <div class="col-sm-6 text-center">
                  <div><span><?php echo ($entrega[0]['firma_usuario']) ?></span></div>
                  <div><?php echo ($entrega[0]['nombre_usuario']) ?><br>(<?php echo ($entrega[0]['cargo_usuario']) ?>)</div>
                </div>
              </div>



            </div>
            <div class="card-footer">
              <b>Nota:</b> Al formatear un equipo, konecta SAS <b>No se hace responsable</b>
              por la información que esté pro fuera de la ruta o carpetas que estén indicadas en esta hoja
            </div>


          </div>
          <?php if ($firma_empleado == "") : ?>
            <div class="text-center mx-auto">
              <center>

                <button type="button" class="btn btn-info mb-3" id="clear">Limpiar Firma</button>
                <div id="content" class="">
                  <div id="signatureparent">
                    <div id="firma"></div>
                  </div>
                </div>
              </center>
              <div class="justify-content-center">
                <div class="text-center">
                  <form action="" id="formIngresoFirma">
                    <input type="hidden" name="idEntrega"value="<?php echo ($idEntrega) ?>">
                    <button type="submit" class="btn btn-dark mt-3" name="botonRegistro" id="botonRegistro">Registrar Firma</button>

                  </form>
                </div>
              </div>
            </div>
          <?php endif ?>



        </div>
        <!-- fin cuerpo de trabajo -->
      </section>
    </div>
    <!-- fin contenido-wrapper -->


  </div>
  <!-- fin wrapper -->
  <?php include "includes/scriptsDown.php" ?>
  <script>
  let firma='<?php echo ($firma_empleado) ?>';
  if(firma!=''){
    window.print();
  }
    
  </script>

  <script>
    $(function() {
      let signatureContainer = $('#firma').jSignature();

      $("#clear").click(function() {
        signatureContainer.jSignature("reset");
      });
      $(document).on('submit', '#formIngresoFirma', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append("native", signatureContainer.jSignature("getData", "native"));
        formData.append("signature", signatureContainer.jSignature("getData", "svg"));

        $.ajax({
          url: "php/ingresarFirma.php",
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data) {
            if (data == 1) {
            
              /* mensaje de registro completado */
              Swal.fire({
                position: 'center',
                icon: 'success',
                html: '<img src="../img/konecta-logo.svg">',
                title: '<br>La firma Se Ha Ingresado Corectamente',
                background: ' #000000cd',
                showConfirmButton: false,
                timer: 2000,
              }).then((result) => {
                window.location = "";
              })
            }else{
              Swal.fire({
                position: 'center',
                icon: 'success',
                html: '<img src="../img/konecta-logo.svg">',
                title: '<br>No se ha escrito ninguna firma',
                background: ' #000000cd',
                showConfirmButton: false,
                timer: 2000,
              })
            }

          }
        });

      });



    });
  </script>
</body>

</html>