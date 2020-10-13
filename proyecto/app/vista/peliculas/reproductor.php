<?php require RUTA_APP . '/vista/inc/header.php'?>
<div class="container">
	<div class="row">

			<div>
				<br>
				<?php echo "<img src='".RUTA_URL."public/img/".$datos['miniatura']."'class='miniatura'>"; ?>
			</div>

			<div class="info-container">
				<br>
				<?php echo "<p class='sinop'>".$datos['sinopsis']."</p>"; ?>

				<?php 

				foreach ($datos['generos'] as $genero) {
					if ($datos['fk_genero'] == $genero->id_genero) {
						echo "<p><strong>Genero:</strong> ".$genero->genero."</p>";
					}
				}

				echo "<p><strong>Reparto: </strong>".$datos['reparto']."</p>";
				?>		
			</div>

			<?php
			if ($_SESSION['RolUsuario'] == 2) {
				echo "<div>";
				echo "<a href='".RUTA_URL."peliculas/eliminar/".$datos['id_pelicula']."'><button class='btnadmin btn btn-danger'>Eliminar Pelicula</button></a>";
				
				echo "<a href='".RUTA_URL."peliculas/editar/".$datos['id_pelicula']."'><button class='btnadmin btn btn-danger'>Modificar Pelicula</button></a>";
				echo "</div>";
			}
			?>

			<div class="col-12">
				<br><br>
				<input type="hidden" id="servidor1" value="<?php echo $datos['servidor1']; ?>">
				<input type="hidden" id="servidor2" value="<?php echo $datos['servidor2']; ?>">
				<input type="hidden" id="servidor3" value="<?php echo $datos['servidor3']; ?>">
				<input type="hidden" id="trailer" value="<?php echo $datos['url_trailer']; ?>">
				
				<div class="reproductor">
					<iframe id="iframePelicula" width="100%" height="580" src="<?php echo $datos['servidor1']; ?>" frameborder="0" allowfullscreen></iframe>
					<button onclick="mostrar()" class="btn btn-lg btn-success">Servidores</button>
					<!--Seccion oculta de servidores-->
					<div id="servers">
						<br>
						<button onclick="server1()" class="btn btn-success">Servidor 1</button>
						<button onclick="server2()" class="btn btn-success">Servidor 2</button>
						<button onclick="server3()" class="btn btn-success">Servidor 3</button>
						<button onclick="trailer()" class="btn btn-success">Trailer</button>

					</div>

				</div>


			</div>
	</div>
</div>





<?php require RUTA_APP . '/vista/inc/footer.php'?>