<?php
$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
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
  <title>INICIO</title>

  <?php include "includes/scriptsUp.php" ?>
</head>

<style>
  #signatureparent {
    color: black;
    background-color: darkgrey;
    max-width: 350px;
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

    <?php include "includes/navbar.php" ?>

    <!-- Contentido Wrapper-->
    <div class="content-wrapper">
      <!-- contenido-header -->
      <div class="content-header">
        <div class="container-fluid">

          <!-- inicio de cuerpo de trabajo -->
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Prueba realizada en PHP nativo por: <br>  William Reyes Miranda <br> cc. 1124023751</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Inicio</li>

              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- contenido-header -->

      <section class="content">
        <!-- inicio cuerpo de trabajo -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              Estos son algunas tecnologías utilizadas en el proyecto:
            </div>
            <div class="col-12">
              <ul>
                <li>Bootstrap v4.6</li>
                <li>Sweetalert2 v10.15.6  <a href="https://sweetalert2.github.io/">https://sweetalert2.github.io/</a></li>
                <li>Jquery - ajax</li>
                <li>Panel administrativo gratis (AdminLTE v3.1.0  <a href="https://adminlte.io">https://adminlte.io</a>)</li>
                <li>Datatable v1.10.24 y exportaciones en Excel, Pdf, CSV, copiar e imprimir <a href="www.datatables.net">www.datatables.net</a></li>
                <li>Select2 v4.0.13<a href="https://select2.github.io">https://select2.github.io</a></li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <h1>Nota:</h1> <br>
              <h5>No se utilizó la sentencia de eliminar, ya que al intentar eliminar el registro de un producto, si este producto se ha realizado alguna venta, entonces este arrojará error, por ser clave primaria de una foránea. Esto ocasionaría que toca hacer un eliminado en cascada, eliminando cualquier venta que el producto haya tenido. <br> Teniendo lo anteriomente mensionado en cuenta, adicioné un campo extra en producto (<b>estado</b>), y si esl producto está inactivo, entonces no aparecerá al registrar la venta.</h5>
            </div>
          </div>
         
        </div>
        <!-- fin cuerpo de trabajo -->
      </section>
    </div>
    <!-- fin contenido-wrapper -->


    <!-- Main Footer -->
    <?php  include "includes/footer.php" ;  ?>

  </div>
  <!-- fin wrapper -->
  <?php include "includes/scriptsDown.php" ?>

</body>
</html>