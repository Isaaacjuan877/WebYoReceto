<?php
include 'conexion.php';

$nombre = filter_var(strtolower($_POST['nombre']), FILTER_SANITIZE_STRING);
$fotografia = addslashes(file_get_contents($_FILES["Imagen"]["tmp_name"]));
$ingredientes = filter_var(strtolower($_POST['ingredientes']), FILTER_SANITIZE_STRING);
$porciones = $_POST['porciones'];
$pasos = filter_var(strtolower($_POST['pasos']), FILTER_SANITIZE_STRING);
$descripcion = $_POST['descripcion'];
$id_usuario = $_POST['id_usuario'];

        $message ='';
        if (empty($nombre) or empty($ingredientes) or empty($porciones) or empty($pasos) or empty($descripcion)) {
            $message .= '<li>Por favor rellena todos los datos</li>';
            } 
        else{
            include 'CreacionRecetas.php';
            if ($_SESSION['Correo']==='admin123@gmail.com') {
                
                $ins = $conn -> query("INSERT INTO recetas(nombre,fotografia,ingredientes,porcionesIngredientes,pasos,descripcion,autor)VALUES ('$nombre','$fotografia','$ingredientes','$porciones','$pasos','$descripcion','$id_usuario')");
                try {
 
                    $conn->exec($ins);
                    $message .= "<li>Receta registrada correctamente</li>";
                    } catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                } 
            }    
            else{
                $ins = $conn -> query("INSERT INTO recetasespera(nombre,fotografia,ingredientes,porcionesIngredientes,pasos,descripcion,id_usuario)VALUES ('$nombre','$fotografia','$ingredientes','$porciones','$pasos','$descripcion','$id_usuario')"); 
                
                try {
 
                    $conn->exec($ins);
                    $message .= "<li>Receta registrada. Sujeta a aprovacion</li>";
                    } catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                } 
            } 
        }
		

require 'CreacionRecetas.php';
	


?>