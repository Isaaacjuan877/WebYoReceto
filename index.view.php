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
  
$recetas= "SELECT * FROM recetas ";
$frecetas=$conn -> query($recetas);
$flrecetas=$frecetas->fetch();

$autor= "SELECT   nombre FROM usuarios WHERE id= $flrecetas[autor]";
$fautor=$conn -> query($autor);


?>
<!DOCTYPE html>
<html lang="es" >
<head>
	<meta name="viewport" content=" width=device-width,user-scalable=no,initial-escalable=1.0,maximun-scalable=1.0,minimum-scalable=1.0">
    <title>YO RECETO</title>
    <meta charset="utf-8">
	
	<link href="https://file.myfontastic.com/tc26fJHv8scB3d4vHQRRsV/icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="Estilos.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--LINKS PARA LAS FUENTES DE TEXTO-->

  	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
	
</head>
<body>
	<div class="contenedor">
	<div class="header">
			<div class="logo"><img src="IMAGENES/LOGOD.png"></div>
			<div class="buscador">
				<form  action="index.php" method="POST">
					<input type="search" name="buscar" placeholder="Buscar" aria-label="Search"
				    aria-describedby="search-addon" />
					<button type="submit"><img src="IMAGENES/LUPA.png"></button>
				</form>
				<?php
				
				?>
			<div>

				<!-- <?php
					/* $search=$_POST['buscar'];
					$busqueda="SELECT * FROM recetas WHERE nombre like '%$search%'";
					$buscar=$conn -> query($busqueda);
 */
				?> -->
				<section class="opcionesbusqueda">
			
				
				
					<?php 
					
					?>
										
						<div class="cajon-opcion-busqueda">
						
								<div class="cajon-imagen-busqueda">

									<img class="imagen" src="data:image/jpg;base64,<?php echo base64_encode($buscar['fotografia']); ?>">
								</div>
								<div class="informacion-busqueda">
									<center>
										
										<p><?php/* echo $buscar['nombre'];*/ ?> </p>
										
										
										
									</center>
								</div>
								
							</form>
						</div>
						
				</section>
			</div>
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
		
		<div class="introduccion">
			<center>
				<h1>¿QUÉ ES "YO RECETO"?</h1>
				<img src="IMAGENES/LOGOD.png">
				<p>El proyecto consiste en una aplicación/sitio web que cuente con un software en el que la persona digite los ingredientes con los que dispone en su cocina y que de esta manera el programa muestre resultados de búsqueda donde aparezcan recetas con solo los elementos que fueron digitados. El objetivo de todo este proceso es reducir los tiempos de búsqueda internautitas que tiene que realizar el usuario, pues a medida que pasa el tiempo las recetas alojadas en las bases de datos que contiene internet crece masiva y rápidamente provocando que las búsquedas se conviertan en actividades tardías y que la información que aparece después de realizar dicha búsqueda sea incoherente con lo que en realidad se requiere, Además se busca implementar el uso de información que sea de relevancia para los usuarios, datos tales como: Cantidad de calorías, Sistema de valorización de rectas, Comentarios, Interacción entre usuarios, entre otros.</p>	
			</center>
		</div>

		<center><h2 class="titulo"> ALGUNAS OPCIONES MAS RECIENTES</h2></center>

		
		<section class="opciones">
			
				
				
			<?php foreach ($query as $row):?>
					
				
			<?php

				
			?>	
			
				<div class="cajon-opcion">
				<form method="GET" action="acocinar.php">
						<div class="cajon-imagen">

							<img class="imagen" src="data:image/jpg;base64,<?php echo base64_encode($row['fotografia']); ?>">
						</div>
					    <div class="informacion">
					    	<center>
						        <form method="POST" action="acocinar.php">
						        <input type="text" class="nombre" name="nombre" value="<?php echo $row['nombre'] ?>" />
						        </form>
						        <p><?php echo $row['descripcion'] ?></p>
						        <button class="boton" type="submit">!A COCINAR!</button>
					        </center>
					    </div>
						
					</form>
		    	</div>
            <?php
						
						?>
						<?php endforeach; 
			?>
</section>

		


		
		
	

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