<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$referencia = $_POST['referencia'];
$nombreProducto = $_POST['nombreProducto'];
$precio = $_POST['precio'];
$peso = $_POST['peso'];
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$estado = $_POST['estado'];


$consultaSQL = "INSERT INTO productos(referencia, nombre_producto, precio, peso, id_categoria, stock, estado) VALUES
                    ('$referencia','$nombreProducto',$precio,$peso,$categoria,$stock, '$estado')";
$insert = $conexion->agregarDatos($consultaSQL);





echo ($insert);
