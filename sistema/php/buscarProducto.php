<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$referencia = $_POST['referencia'];
$consultaSQL = "SELECT pr.*, ct.nombre_categoria FROM productos pr
        INNER JOIN categorias ct ON ct.id_categoria=pr.id_categoria where pr.referencia = '$referencia' and pr.estado='Activo' ";
$productos = $conexion->consultarDatos($consultaSQL);

// $update = $conexion->editarDatos($consultaSQL);





echo json_encode($productos[0]);
