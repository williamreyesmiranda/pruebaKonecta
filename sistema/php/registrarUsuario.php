<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$nombre = $_POST['nombre'];
$cargo = $_POST['cargo'];
$area = $_POST['area'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$correo = $_POST['correo'];


$consultaSQL = "INSERT INTO usuario(nombre_usuario, cargo_usuario, rol, usuario_sesion, clave, correo_usuario) VALUES
                    ('$nombre','$cargo','$area','$usuario','$clave','$correo')";
$insert = $conexion->agregarDatos($consultaSQL);





echo ($insert);
