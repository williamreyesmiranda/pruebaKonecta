<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../img/konecta-logo.svg" width="300">
</div> -->

<nav class="main-header navbar navbar-expand navbar-dark">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <ul class="navbar-nav ml-auto">
        <li class="nav-item my-auto" style="padding-left: 15px;">
            <?php echo ($_SESSION['nombre']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Pantalla Completa">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../db/logout.php" title="Salir">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index.php" class="brand-link text-center">
        <img src="../img/konecta-logo.svg" alt="AdminLTE Logo" class="brand-imageelevation-3" style="opacity: .8" height="30">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="vistaVenta.php" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <p>Registrar Venta</p>
                    </a>
                </li>  
                <li class="nav-item">
                    <a href="listaProductos.php" class="nav-link">
                    <i class="fa fa-asterisk" aria-hidden="true"></i>
                        <p> Lista Productos</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="listaVentas.php" class="nav-link">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <p> Ventas Realizadas</p>
                    </a>
                </li> 
                <?php if($_SESSION['idrol']==1):?>                           
                <li class="nav-item">
                    <a href="listaUsuarios.php" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                        <p> Lista Usuarios (konecta)</p>
                    </a>
                </li>
                <?php endif?>
                
                
            </ul>
        </nav>

    </div>

</aside>

<!-- Modal Registrar Empleado-->
<div class="modal fade" id="modalRegistrarEmpleado">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-md-12 d-block border border-dark rounded col-md-12 mb-4">
                <form method="post" id="registrarEmpleado">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre">Nombre Empleado:</label>
                            <input type="text" name="nombre" class="form-control nombre" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <?php
                            $consultaProcesos = "SELECT * FROM empresas WHERE estado_empresa=1";
                            $empresas = $conexion->consultarDatos($consultaProcesos);
                            ?>
                            <label for="empresa">Empresa (*):</label>
                            <select class="form-control" name="empresa" required>
                                <option value="" selected disabled>Seleccione Una Empresa</option>
                                <?php foreach ($empresas as $empresa) : ?>
                                    <option value="<?php echo ($empresa['id_empresa']) ?>"><?php echo ($empresa['nombre_empresa']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Ingrese la empresa</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cargo">Cargo:</label>
                            <input type="text" name="cargo" class="form-control cargo" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" class="form-control correo" autocomplete="off">
                            
                        </div>

                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrarEmpleado()">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>