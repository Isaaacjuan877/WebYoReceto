
<?php
include 'conexion.php';
$id = $_POST['id'];
$nombre = filter_var(strtolower($_POST['nombre']), FILTER_SANITIZE_STRING);
/* $fotografia = addslashes(file_get_contents($_FILES["Imagen"]["tmp_name"])); */
$ingredientes = filter_var(strtolower($_POST['ingredientes']), FILTER_SANITIZE_STRING);
$porciones = $_POST['porciones'];
$pasos = filter_var(strtolower($_POST['pasos']), FILTER_SANITIZE_STRING);
$descripcion = $_POST['descripcion'];




$elim = $conn -> query("DELETE FROM recetasEspera WHERE id=$id"); 

require 'recetasEspera.php';
	
?>
