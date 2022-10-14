<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$usuario = $_SESSION['iduser'];

$idProductos = $_POST['idProducto'];
$cantidades = $_POST['cantidad'];
$stock = $_POST['stock'];




$consultaSQL = "INSERT INTO venta_encabezado(id_usuario) VALUES
                    ($usuario)";
$insert = $conexion->agregarDatos($consultaSQL);

if($insert == 1){
    $consultaSQL = "select max(id_venta) as max from venta_encabezado ";
    $resp = $conexion->consultarDatos($consultaSQL);
    
    $max = $resp[0]['max'];
    $contar = 0;
    foreach($cantidades as $cantidad){
        $consultaSQL = "INSERT INTO venta_detalle ( id_venta, id_producto, cantidad) VALUES ($max,$idProductos[$contar], $cantidad);";
        $insert = $conexion->agregarDatos($consultaSQL);
        

        if($insert == 1){
            $saldoActual = intval($stock[$contar])-intval($cantidad);

            $consultaSQL="UPDATE productos SET stock=$saldoActual WHERE id_producto=$idProductos[$contar]";
             $update = $conexion->editarDatos($consultaSQL);
        }
        $contar++;
    }
}







echo ($update);
