<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();
$idProducto = $_POST['idProducto'];
$referencia = $_POST['referencia'];
$nombreProducto = $_POST['nombreProducto'];
$precio = $_POST['precio'];
$peso = $_POST['peso'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$estado = $_POST['estado'];

$consultaSQL="UPDATE productos SET referencia='$referencia',nombre_producto='$nombreProducto',precio=$precio,peso=$peso,id_categoria=$categoria,stock=$stock, estado='$estado' WHERE id_producto=$idProducto";


$update = $conexion->editarDatos($consultaSQL);





echo ($update);
