<?php

session_start();
if (isset($_SESSION['Correo'])) {
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
		

		<center><h2 class="titulo"> RECETAS</h2></center>
		<section class="opciones">
			
				
				
				<?php foreach ($query as $row):?>
					
				
			<?php

				
			?>	
			
				<div class="cajon-opcion">
			
						<div class="cajon-imagen">

							<img class="img" src="data:image/jpg;base64,<?php echo base64_encode($row['fotografia']); ?>">
						</div>
					    <div class="informacion">
					    	<center>
						        <h3><?php echo $row['nombre'] ?></h3>
						        <p><?php echo $row['descripcion'] ?></p>
						        <button class="boton"><a href="file:///C:/Users/ESTUDIANTE/Desktop/PROYECTO/BOOSTRAP2.html" class="btn btn-danger">!A COCINAR!</a></button>
					        </center>
					    </div>
						
		    	</div>
            <?php
						
						?>
						<?php endforeach; 
			?>
</section>
<center>
	<div class="paginacion">
			
			<ul>
				<?php if($pagina==1): ?>
					<li class="disabled">&laquo;</li>
				<?php else: ?>
					<li><a href="?pagina=<?php echo $pagina -1?>">&raquo;</a></li>
				<?php endif; ?>
				<?php 
				for ($i=1; $i <= $numeroPaginas; $i++) { 
				 	if ($pagina===$i) {
				 		echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";

				 	}else{
				 		echo "<li><a href='?pagina=$i'>$i</a></li>";
				 	}
				 } 
				 ?>
				 <?php if ($pagina==$numeroPaginas):?>
				 	<li class="disabled">&raquo;</li>
				 <?php else: ?>	
				 	<li><a href="?pagina=<?php echo $pagina +1?>">&raquo;</a></li>
				 <?php endif; ?>
			</ul>
		</div>
</center>
				
		
<main>
        
        <hr class="line">
		
		
        <div class="container-comments">
			<div class="comments">
				
				
				<div class="info-comments">
				<?php
					if (isset($_SESSION['Correo'])) {
				?>
					<div class="headerc">
						<h4><?php if(!empty($usuarios)): ?>
							<?= $usuarios['nombres'] ?>
							<?php endif; ?></h4>
						
					</div>
					<?php

					}else{
						?>
						<div class="headerc">
							<h4>Usuario YORECETO</h4>
						
					</div>
					<?php
					}
					?>
					
					<form action="nuevoComentario.php" method="POST">
						
							<input name="id_receta" type="hidden" value="<?php echo $results['id']?>">
							<input name="id_usuario" type="hidden" value="<?php echo $usuarios['id']?>">
							<input name="comentario" type="text">
							
							<input class="boton" type="submit" value="Publicar">
							
						</form>
					
					
				</div>
				
			</div>
			
				
		</div>
	
		
        
		<?php 
		
			$sqlC = "SELECT * FROM comentarios WHERE id_receta=$results[id] order by id desc";
		
				$resCom=$conn -> query($sqlC);
		
		
			
				
			// output data of each row
			while($row=$resCom->fetch()) {

				$sqlU = "SELECT  id, concat(Nombre, ' ',II_nombre, ' ', Apellido, ' ', II_apellido) as nombres FROM usuarios WHERE id=$row[id_usuario]";
				$resUs=$conn -> query($sqlU);
				$resU=$resUs->fetch()
				?>
			<div class="container-comments">
			
				<div class="comments">
				
					
					
					<div class="info-comments">
					
						<div class="headerc">

							<h4><?php echo $resU['nombres'];?></h4>
							<h5>25 noviembre 2017</h5>
						</div>
						
						<p><?php echo $row['comentario']; ?></p>
						
						<div class="footer">
						
							<h5 class="request">Responder</h5>
							<label class="icon-heart"></label>
							
						</div>
					</div>
					
				</div>
				<div class="container-comments-request">
           
		  			<div class="comments-request">
			  
			  
			   
						<div class="info-comments-request">
							
							<div class="headerc">
								<h4> </h4>
								<h5>25 noviembre 2017</h5>
							</div>
							
							<p></p>
							
							<div class="footer">
								
								<h5 class="request">Responder</h5>
								<label class="icon-heart"></label>
								
							</div>
						</div>
			   
					</div>
				</div>
			</div>
			
			
			<?php
			}
			?>
	
	

		
		
		
			
        
        
    </main>

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