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
            <th>Fecha Venta</th>
            <th>Vendedor</th>
            <th>Referencia</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            
        </tr>

    </thead>

    <tbody>

        <?php include("../../db/Conexion.php");
        $conexion = new Conexion();
        $consultaSQL = "select * from venta_encabezado ve
                        INNER JOIN venta_detalle vd ON vd.id_venta=ve.id_venta
                        INNER JOIN usuario us ON us.id_usuario=ve.id_usuario
                        INNER JOIN productos pr ON pr.id_producto=vd.id_producto";
        $ventas = $conexion->consultarDatos($consultaSQL);
        foreach ($ventas as $venta) :      


        ?>
            <tr class="text-center">
                <td><?php echo $venta['id_venta']; ?></td>
                <td><?php echo $venta['fecha_venta']; ?></td>
                <td><?php echo $venta['nombre_usuario']; ?></td>
                <td><?php echo $venta['referencia']; ?></td>
                <td><?php echo $venta['nombre_producto']; ?></td>
                <td><?php echo $venta['precio']; ?></td>
                <td><?php echo $venta['cantidad']; ?></td>
                
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