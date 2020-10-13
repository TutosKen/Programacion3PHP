<?php require RUTA_APP . '/vista/inc/header.php'?>

	<div class="container">
		<div class="row">
			<div class="color1 col-12">

		<?php foreach($datos['busqueda'] as $pelicula){
			echo "<div id='contenedor-pelicula'>";
			echo "<a href='".RUTA_URL."peliculas/visualizar/".$pelicula->id_pelicula."'><img src='".RUTA_URL."public/img/".$pelicula->miniatura."'class='miniatura'> ";
			echo "<p>".$pelicula->nombre."</p></a>";
			echo "</div>";
			}
?>

		 	</div>

		</div>
	</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>


