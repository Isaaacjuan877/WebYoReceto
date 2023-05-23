<?php
include 'conexion.php';


$id=$_POST['id'];
$nombre=$_POST['nombre'];
$II_nombre=$_POST['s_nombre'];
$apellido=$_POST['apellido'];
$II_apellido=$_POST['s_apellido'];
$correo=filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_STRING);
$clave=$_POST['clave'];
$c_clave=$_POST['c_clave'];

$ins = $conn -> query("UPDATE usuarios SET Nombre='$nombre', II_nombre='$II_nombre', Apellido='$apellido', II_apellido='$II_apellido', Correo='$correo',Clave='$clave', Confirm_clave='$c_clave' WHERE id='$id'");

require 'perfil.php';

?>