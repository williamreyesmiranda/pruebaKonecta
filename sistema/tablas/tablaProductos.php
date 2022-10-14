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
            <th>Referencia</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Peso</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Fecha Creacion</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

        <?php include("../../db/Conexion.php");
        $conexion = new Conexion();
        $consultaSQL = "SELECT pr.*, ct.nombre_categoria FROM productos pr
        INNER JOIN categorias ct ON ct.id_categoria=pr.id_categoria ";
        $productos = $conexion->consultarDatos($consultaSQL);
        foreach ($productos as $producto) :
            $datos = $producto['id_producto'] . "||" . $producto['referencia'] . "||" . $producto['nombre_producto'] . "||" . $producto['precio']
            . "||" . $producto['peso'] . "||" . $producto['id_categoria'] . "||" . $producto['stock'] . "||" . $producto['estado'];


        ?>
            <tr class="text-center">
                <td><?php echo $producto['id_producto']; ?></td>
                <td><?php echo $producto['referencia']; ?></td>
                <td><?php echo $producto['nombre_producto']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['peso']; ?></td>
                <td><?php echo $producto['nombre_categoria']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                <td><?php echo $producto['estado']; ?></td>
                <td><?php echo $producto['fecha_creacion']; ?></td>
                <td>
                    <h5>
                        <button class="btn btn-info" id="" title="Editar Usuario" onclick="formEditarProducto('<?php echo ($datos); ?>')"><i class="fas fa-user-edit"></i></i></button>

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
                [2, "asc"]
            ],
            "pageLength": 10,
            "language": {
                "url": "../plugins/datatables/Spanish.json"
            },
        });
    });
</script>