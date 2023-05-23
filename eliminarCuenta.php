<?php
include 'conexion.php';


$id=$_POST['id'];

$ins = $conn -> query("DELETE FROM usuarios WHERE id='$id'");


require 'cerrar.php';

?>