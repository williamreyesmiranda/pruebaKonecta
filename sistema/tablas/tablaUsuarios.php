<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<table class="table table-hover table-condensed table-bordered tablaDinamica" id="" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Área</th>
            <th>Usuario Sesión</th>
            <th>Clave</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

        <?php include("../../db/Conexion.php");
        $conexion = new Conexion();
        $consultaSQL = "SELECT * FROM usuario us 
        INNER JOIN rol rl ON rl.id_rol=us.rol
                        ";
        $usuarios = $conexion->consultarDatos($consultaSQL);
        foreach ($usuarios as $usuario) :
            $datos = $usuario['id_usuario'] . "||" . $usuario['nombre_usuario'] . "||" . $usuario['cargo_usuario']
                . "||" . $usuario['rol'] . "||" . $usuario['usuario_sesion'] . "||" . $usuario['clave'] . "||" . $usuario['correo_usuario'];


        ?>
            <tr class="text-center">
                <td><?php echo ($usuario['id_usuario']); ?></td>
                <td><?php echo ($usuario['nombre_usuario']); ?></td>
                <td><?php echo ($usuario['cargo_usuario']); ?></td>
                <td><?php echo ($usuario['nombre_rol']); ?></td>
                <td><?php echo ($usuario['usuario_sesion']); ?></td>
                <td><?php echo ($usuario['clave']); ?></td>
                <td><?php echo ($usuario['correo_usuario']); ?></td>
                <td>
                    <h5>
                        <button class="btn btn-info" id="" title="Editar Usuario" onclick="formEditarusuario('<?php echo ($datos); ?>')"><i class="fas fa-user-edit"></i></i></button>

                    </h5>
                </td>
            </tr>

        <?php

        endforeach;  ?>

    </tbody>
</table>
<!-- <script src="js/scri.js"></script> -->
<!-- datatable -->
<script>
    $(document).ready(function() {

        $('.tablaDinamica').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5',
                'print',
                'csv'
            ],
            responsive: true,
            "order": [
                [1, "asc"]
            ],
            "pageLength": 10,
            "language": {
                "url": "../plugins/datatables/Spanish.json"
            },
        });
    });
</script>