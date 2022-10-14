<?php
session_start();
include "../db/Conexion.php";
$conexion = new Conexion();

if (empty($_SESSION['active'])) {
    header('location: ../');
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Usuarios</title>

    <?php include "includes/scriptsUp.php" ?>
</head>
<style>

</style>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include "includes/navbar.php" ?>

        <!-- Contentido Wrapper-->
        <div class="content-wrapper">
            <!-- contenido-header -->
            <div class="content-header">
                <div class="container-fluid">

                    <!--  -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 mb-3">Lista de Usuarios</h1>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalRegistrarUsuario">
                                Registrar Usuario
                            </button>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Tabla Usuarios</li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contenido-header -->

            <section class="content">
                <!-- inicio cuerpo de trabajo -->
                <div class="container-fluid">

                    <div class="mostrarTabla"></div>
                    
                </div>
                <!-- fin cuerpo de trabajo -->
            </section>
        </div>
        <!-- fin contenido-wrapper -->
        <!-- Main Footer -->
        <?php include "includes/footer.php" ?>

        <!-- Modal REgistrar usuario-->
        <div class="modal fade" id="modalRegistrarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="registrarUsuario">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control nombre">
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo:</label>
                                <input type="text" name="cargo" class="form-control cargo">
                            </div>
                            <div class="form-group">
                                <label for="area">Área:</label>
                                <select name="area" class="form-control area">
                                    <?php
                                    $consultaSQL = "SELECT * FROM rol";
                                    $roles = $conexion->consultarDatos($consultaSQL);
                                    foreach ($roles as $rol) :
                                    ?>
                                        <option value="<?php echo ($rol['id_rol']) ?>"><?php echo ($rol['nombre_rol']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" class="form-control usuario">
                            </div>
                            <div class="form-group">
                                <label for="clave">Clave:</label>
                                <input type="password" name="clave" class="form-control clave">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="text" name="correo" class="form-control correo">
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="registrarUsuario()">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar usuario-->
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editarUsuario">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="hidden" name="idUsuario" class="idUsuario">
                                <input type="text" name="nombre" class="form-control nombre">
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo:</label>
                                <input type="text" name="cargo" class="form-control cargo">
                            </div>
                            <div class="form-group">
                                <label for="area">Área:</label>
                                <select name="area" class="form-control area">
                                    <?php
                                    $consultaSQL = "SELECT * FROM rol";
                                    $roles = $conexion->consultarDatos($consultaSQL);
                                    foreach ($roles as $rol) :
                                    ?>
                                        <option value="<?php echo ($rol['id_rol']) ?>"><?php echo ($rol['nombre_rol']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" class="form-control usuario">
                            </div>
                            <div class="form-group">
                                <label for="clave">Clave:</label>
                                <input type="password" name="clave" class="form-control clave">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="text" name="correo" class="form-control correo">
                            </div>
                            <div class="form-group">
                                <label for="firma">Desea Borrar Firma:</label>
                                <select name="firma" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="si">Si</option>
                                </select>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="editarUsuario()">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin wrapper -->
    <?php include "includes/scriptsDown.php" ?>

    <script>
        $(document).ready(function() {
            $('.mostrarTabla').load('tablas/tablaUsuarios.php');

        });
    </script>

</body>

</html>