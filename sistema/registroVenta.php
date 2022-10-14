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
    <title>Lista Productos</title>

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
                            <h1 class="m-0 mb-3">Lista de Productos</h1>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalRegistrarProducto">
                                Registrar Producto
                            </button>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Tabla Productos</li>

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

        <!-- Modal Registrar producto-->
        <div class="modal fade" id="modalRegistrarProducto" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="registrarProducto">
                        <div class="form-group">
                                <label for="referencia">Referencia:</label>
                                <input type="text" name="referencia" class="form-control referencia">
                            </div>
                            <div class="form-group">
                                <label for="nombreProducto">Nombre Producto:</label>
                                <input type="text" name="nombreProducto" class="form-control nombreProducto">
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" name="precio" class="form-control precio">
                            </div>
                            <div class="form-group">
                                <label for="peso">Peso:</label>
                                <input type="number" name="peso" class="form-control peso">
                            </div>
                            <div class="row">
                            <div class="form-group col-12">
                                <label for="categoria">Categoría:</label>
                                <select name="categoria" class="form-control categoria select2">
                                    <option value="" selected disabled>Selecciona una Categoria</option>
                                    <?php
                                    $consultaSQL = "SELECT * FROM categorias";
                                    $categorias = $conexion->consultarDatos($consultaSQL);
                                    foreach ($categorias as $categoria) :
                                    ?>
                                        <option value="<?php echo ($categoria['id_categoria']) ?>"><?php echo ($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </div>                            
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="text" name="stock" class="form-control stock">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control estado">
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="registrarProducto()">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar producto-->
        <div class="modal fade" id="modalEditarProducto" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editarProducto">
                            <div class="form-group">
                                <label for="idProducto">ID:</label> <span class="idProducto h5 ml-3"></span>
                                <input type="hidden" name="idProducto" class="idProducto">
                            </div>
                            <div class="form-group">
                                <label for="referencia">Referencia:</label>
                                <input type="text" name="referencia" class="form-control referencia">
                            </div>
                            <div class="form-group">
                                <label for="nombreProducto">Nombre Producto:</label>
                                <input type="text" name="nombreProducto" class="form-control nombreProducto">
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" name="precio" class="form-control precio">
                            </div>
                            <div class="form-group">
                                <label for="peso">Peso:</label>
                                <input type="number" name="peso" class="form-control peso">
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoría:</label>
                                <select name="categoria" class="form-control categoria select2">
                                    <?php
                                    $consultaSQL = "SELECT * FROM categorias";
                                    $categorias = $conexion->consultarDatos($consultaSQL);
                                    foreach ($categorias as $categoria) :
                                    ?>
                                        <option value="<?php echo ($categoria['id_categoria']) ?>"><?php echo ($categoria['nombre_categoria']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="text" name="stock" class="form-control stock">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="editarProducto()">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin wrapper -->
    <?php include "includes/scriptsDown.php" ?>

    <script>
        $(document).ready(function() {
            $('.mostrarTabla').load('tablas/tablaProductos.php');

        });
    </script>

</body>

</html>