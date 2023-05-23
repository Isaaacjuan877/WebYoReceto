<?php
session_start();
if (isset($_SESSION['Correo'])) {
	
}

include 'conexion.php';



if (isset($_SESSION['Correo'])) {
	$records = $conn->prepare('SELECT  id, concat(Nombre, " ",II_nombre, " ", Apellido, " ", II_apellido) as nombres FROM usuarios WHERE Correo = :Correo');
	$records->bindParam(':Correo', $_SESSION['Correo']);
	$records->execute();
	$resultados = $records->fetch(PDO::FETCH_ASSOC);

	$usuarios[] = null;

	if (count($resultados) > 0) {
	$usuarios = $resultados;
	}
}
  $message ='';
  
  

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nomb = filter_var(strtolower($_POST['nombreReceta']), FILTER_SANITIZE_STRING);
	
	
	

	

  if (!empty($_POST['nombreReceta'])) {
  	

	
    $rec = $conn->prepare('SELECT * FROM recetasEspera WHERE nombre = :nomb ');
    
    $rec->execute(array(
		':nomb' => $nomb
	));
	$results = $rec->fetch();
	
    
}
else {
	$message ='Error en la busqueda';
  }
}


 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content=" width=device-width,user-scalable=no,initial-escalable=1.0,maximun-scalable=1.0,minimum-scalable=1.0">
    <title>YO RECETO</title>
    <meta charset="utf-8">
	<link href="https://file.myfontastic.com/tc26fJHv8scB3d4vHQRRsV/icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="Estilos.css">
</head>
<body>
	<div class="contenedor">
	<div class="header">
			<div class="logo"><img src="IMAGENES/LOGOD.png"></div>
			<div class="buscador">
				<form  action="recetaEncontrada.php" method="POST">
					<input type="search" name="buscar" placeholder="Buscar" aria-label="Search"
				    aria-describedby="search-addon" />
					<button type="submit"><img src="IMAGENES/LUPA.png"></button>
			</form>
			</div>
			<div class="menu">
			<nav>
					<?php 
					if (isset($_SESSION['Correo'])) {
						
						if($_SESSION['Correo']!=='admin123@gmail.com') {
							?>
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="RectaDiaria.php">Receta del dia</a></li>
							<li><a href="recetas.php">Recetas</a></li>
						
							<li><a href="CreacionRecetas.php">Crear receta</a></li>
							<?php
							if (!isset($_SESSION['Correo'])) {
							?>
							<li><a href="InicioSesion.php">Iniciar sesión</a></li>
							<?php
							}
							else{
							?>
							
							<?php
							}
							?>
							<li><a><?php if(!empty($usuarios)): ?>
								<?= $usuarios['nombres'] ?>
								<?php endif; ?></a>
								
									<ul>
										<li><a href="perfil.php">Ver perfil</a></li>								
										<li><a href="cerrar.php">Cerrar sesion</a></li>
									</ul>
								
							</li>
						</ul>
						<?php
						}else{
							?>
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="CreacionRecetas.php">Crear recetas</a></li>
							<li><a href="recetasEspera.php">Recetas en espera</a></li>
							<li><a href="">Comentarios reportados</a></li>
							<?php
							if (!isset($_SESSION['Correo'])) {
							?>
							<li><a href="InicioSesion.php">Iniciar sesión</a></li>
							<?php
							}
							else{
							?>
								

							
							<li><a><?php if(!empty($usuarios)): ?>
								<?= $usuarios['nombres'] ?>
								<?php endif; ?></a>
								<ul>
									<li><a href="perfil.php">Ver perfil</a></li>								
									<li><a href="cerrar.php">Cerrar sesion</a></li>
								</ul>
							</li>
							<?php
							

							}
						
						}
					}else{
						?>
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="RectaDiaria.php">Receta del dia</a></li>
							<li><a href="recetas.php">Recetas</a></li>
							
							<li><a href="CreacionRecetas.php">Crear receta</a></li>
							<li><a href="InicioSesion.php">Iniciar sesión</a></li>
							
						</ul>
						<?php

					}
						?>
				</nav>
			</div>
		</div>
		
		
		<center><h2 class="titulo"><?php echo $results['nombre'] ?></h2></center>

		
		<section class="opciones-receta">
			
				<div class="cajon-receta">
			
						<div class="cajon-imagen-receta">
							<?php

								
							?>
							
							<img class="imagen" src="data:image/jpg;base64,<?php echo base64_encode($results['fotografia']); ?>">
							<a href="download.php"class="boton">Descargar</a>
						</div>
					    <div class="informacion-receta">
					    	
					    		<div>
					    			<h1>Ingredientes</h1>
					    			 <p><?php echo $results['porcionesIngredientes'] ?></p></div>
						       
						        <div>
						        	<h1>Pasos</h1>
						        	 <p><?php echo $results['pasos'] ?></p>
						        </div>
						       
						       
					        
					    </div>
                        
						

						
		    	</div>
				
                
                
           
        </section>
		<?php
			
			
		?>
		<div class="comments">  
                            <div class="info-comments">
                                <div class="footer">
                                <form action="revisionAceptada.php" method="POST" enctype="multipart/form-data">

										<input class="cajon-texto" name="id" type="hidden" value="<?php echo $results['id']; ?>">

                                        <input class="cajon-texto" name="nombre" type="hidden" value="<?php echo $results['nombre']; ?>">
                                      
                                       	<input  type="file"  class="cajon-texto" name="imagen" required> 
                                        
                                        <input class="cajon-texto" name="ingredientes" type="hidden" value="<?php echo $results['ingredientes']; ?>">
                                        
                                        <input class="cajon-texto" name="porciones" type="hidden" value="<?php echo $results['porcionesIngredientes']; ?>">
                                       
                                        <input class="cajon-texto" name="pasos" type="hidden" value="<?php echo $results['pasos']; ?>">

                                        <input class="cajon-texto" name="descripcion" type="hidden" value="<?php echo $results['descripcion']; ?>">
                                        
										<input class="cajon-texto" name="autor" type="hidden" value="<?php echo $results['id_usuario']; ?>">

                                    <button class="publicar"type="submit" >Publicar</button>
                                    
                                    </form> 

                             
                                                
                                    
                                </div>   
                        
                            </div>   
							<div class="info-comments">
                                <div class="footer">
                                <form  action="revisionRechazada.php" method="POST" enctype="multipart/form-data">

										<input class="cajon-texto" name="id" type="hidden" value="<?php echo $results['id']; ?>">

                                        <input class="cajon-texto" name="nombre" type="hidden" value="<?php echo $results['nombre']; ?>">
                                      
                                       <!-- <input  type="hidden" class="cajon-texto" name="Imagen" value="<?php echo base64_encode( $results['fotografia']); ?>"> -->
                                        
                                        <input class="cajon-texto" name="ingredientes" type="hidden" value="<?php echo $results['ingredientes']; ?>">
                                        
                                        <input class="cajon-texto" name="porciones" type="hidden" value="<?php echo $results['porcionesIngredientes']; ?>">
                                       
                                        <input class="cajon-texto" name="pasos" type="hidden" value="<?php echo $results['pasos']; ?>">

                                        <input class="cajon-texto" name="descripcion" type="hidden" value="<?php echo $results['descripcion']; ?>">
                                        
										
                                    
                                    
                                    <button class="nopublicar" type="submit" >No publicar</button>
                                    </form> 

                             
                                                
                                    
                                </div>   
                        
                            </div>   
                        </div>
		
		

	
	</div>

	<footer>

		<div class="footer-superior">
			<div class="info-footer">
				<strong><h3>Descarga nuestra app</h3></strong>
				<a href=""><img style="height: 80px;" src="IMAGENES/LOGOAPPSTORE.png"></a>
				<a href=""><img style="height: 60px;" src="IMAGENES/LOGOPLAYSTORE.png"></a>
			</div>
			<div class="info-footer">
				<strong><h3>Te puede interesar</h3></strong>
				<p>Condiciones de uso</p>
				<p>Información Legal Colombia</p>
				<p>Politica de privacidad</p>
				<p>Características del prducto</p>
			</div>
			<div class="info-footer">
				<strong><h3>Contactanos</h3></strong>
				<p>Carrera 48 # 26 - 85 Medellín – Colombia</p>
				<p>yoreceto@gmail.com</p>
				<p>Bogotá (57 1) 343 00 00</p>
				<p>Medellín (57 4) 510 90 00</p>
				<p>Cali (57 2) 554 05 05</p>
				<p>Cartagena (57 7) 697 25 25</p>
			</div>
		</div>

		<hr>

		<div class="footer-inferior">
			<img src="IMAGENES/LOGOD.png">
			<strong><p>Copyright © 2021 - YO RECETO</p></strong>
			<a href=""><img src="IMAGENES/LOGOFACE.png" class="logo2"></a>
			<a href="https://www.instagram.com/"><img src="IMAGENES/LOGOINSTA.png" class="logo2"></a>
			<a href=""><img src="IMAGENES/LOGOPINTEREST.png" class="logo2"></a>
			<a href=""><img src="IMAGENES/LOGOTWITTER.png" class="logo2"></a>
		</div>

	</footer>

</body>
</html>