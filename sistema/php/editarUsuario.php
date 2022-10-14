<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$idUsuario=$_POST['idUsuario'];
$nombre=$_POST['nombre'];
$cargo=$_POST['cargo'];
$area=$_POST['area'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$correo=$_POST['correo'];
$firma=$_POST['firma'];

if($firma=="si"){
    $consultaSQL="UPDATE usuario SET nombre_usuario='$nombre',cargo_usuario='$cargo',rol='$area',usuario_sesion='$usuario',clave='$clave',correo_usuario='$correo',firma_usuario=NULL WHERE id_usuario=$idUsuario";
}else{
    $consultaSQL="UPDATE usuario SET nombre_usuario='$nombre',cargo_usuario='$cargo',rol='$area',usuario_sesion='$usuario',clave='$clave',correo_usuario='$correo' WHERE id_usuario=$idUsuario";
}

$update = $conexion->editarDatos($consultaSQL);





echo ($update);
