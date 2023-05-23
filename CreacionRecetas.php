<?php
  include 'conexion.php';
session_start();
if (isset($_SESSION['Correo'])) {
	require 'conexion.php';
}

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
 
  


	
    

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content=" width=device-width,user-scalable=no,initial-escalable=1.0,maximun-scalable=1.0,minimum-scalable=1.0">
    <title>YO RECETO</title>
    <meta charset="utf-8">
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
		<?php
		if (isset($_SESSION['Correo'])) {
		?>
		<div class="caja-inciarsesion">
            <center>
			<h1 class="titulo">Registra tu propia receta</h1>
			<div class="inciarsesion">
				<form action="registroReceta.php" method="POST" enctype="multipart/form-data">
					<label style="color:red;">Nombre de la receta*</label>
				    <input class="cajon-texto" name="nombre" type="text" placeholder="Nombre de la receta">
					<label style="color:red;">Añade una imagen de tu receta</label><br><br>
					<input type="file" class="cajon-texto" name="Imagen"  required>
					<label style="color:red;">Debes incluir condimentos y especias*</label>
					<input class="cajon-texto" name="ingredientes" type="text" placeholder="Ingresa una los ingredientes ">
					<label style="color:red;">Da las cantidades de cada ingrediente*</label>
					<input class="cajon-texto" name="porciones" type="text" placeholder="Porciones de los ingredientes">
					<label style="color:red; margin: 30px;">Se lo más claro posible y no hagas pasos que sean demasiado largos*</label>
					<input class="cajon-texto" name="pasos" type="text" placeholder="Paso a paso de la realización de la receta">
					<label style="color:red;">Una descrcipcion pequeña con más de 50 palabras pero menos de 200*</label>
					<input class="cajon-texto" name="descripcion" type="text" placeholder="Descrcipcion de la receta">
					<input class="cajon-texto" name="id_usuario" type="hidden" value="<?php echo $usuarios['id']?>" >
					
                    <?php
					 
					   if(!empty($message)): ?>
					<div>
						<ul>
						<?php echo $message; ?>
						</ul>
					</div>
						<?php endif; ?>
                    <input class="boton-enviar"  type="submit" value="REGISTRAR RECETA">
                    
                    
				</center>
				</form> 
				
            </div>
		</div>
		<?php

		}else{
			?>
			<section class="opciones-receta">
			
			<div class="cajon-receta">
		
					<div class="cajon-imagen-receta">

						<img class="imagen" src="IMAGENES/Inicio.jpg">
					</div>
					
			</div>
	   
	</section>
		<?php
		}

		?>
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