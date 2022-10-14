<?php
session_start();
include("Conexion.php");

$conectar = new Conexion();
$user = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$pass = (isset($_POST['password'])) ? $_POST['password'] : '';

$consultaSQL = "SELECT us.id_usuario, us.nombre_usuario, us.usuario_sesion, us.correo_usuario,
rl.nombre_rol, rl.id_rol FROM usuario us 
INNER JOIN rol rl ON rl.id_rol=us.rol
WHERE us.usuario_sesion= '$user' AND us.clave= '$pass'";

$data = $conectar->consultarDatos($consultaSQL);
if ($data) {
    
    $_SESSION['active'] = true;
    $_SESSION['iduser'] = $data[0]['id_usuario'];
    $_SESSION['nombre'] = $data[0]['nombre_usuario'];
    $_SESSION['user'] = $data[0]['usuario_sesion'];
    $_SESSION['correo'] = $data[0]['correo_usuario'];
    $_SESSION['rol'] = $data[0]['nombre_rol'];
    $_SESSION['idrol'] = $data[0]['id_rol'];


    echo json_encode(1);
} else {
    echo json_encode(-1);
}
  


