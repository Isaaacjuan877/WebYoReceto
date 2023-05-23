
<?php
include 'conexion.php';

$nombre=$_POST['nombre'];
$II_nombre=$_POST['s_nombre'];
$apellido=$_POST['apellido'];
$II_apellido=$_POST['s_apellido'];
$correo=filter_var(strtolower($_POST['correo']), FILTER_SANITIZE_STRING);
$clave=$_POST['clave'];
$c_clave=$_POST['c_clave'];

$message ='';
if (empty($correo) or empty($clave) or empty($c_clave)) {
		$message .= '<li>Por favor rellena todos los datos</li>';
} else {
		
		$statement = $conn->prepare('SELECT * FROM usuarios WHERE Correo = :correo LIMIT 1');
		$statement->execute(array(':correo' => $correo));
		$resultado = $statement->fetch();


		if ($resultado != false) {
			$message .= '<li>Usuario existente</li>';
		}else{
            $ins = "INSERT INTO usuarios(Nombre,II_nombre,Apellido,II_apellido,Correo,Clave,Confirm_clave)VALUES ('$nombre','$II_nombre','$apellido','$II_apellido','$correo','$clave','$c_clave')";
            try {
 
                $conn->exec($ins);
                $message .= "<li>usuario insertado correctamente</li>";
                } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
		if ($clave != $c_clave) {
			$message .= '<li>No coinsiden las contraseñas</li>';
		}
	}	
	
		
        
    
   

		
		
		

		require 'Registro.php';
	


?>