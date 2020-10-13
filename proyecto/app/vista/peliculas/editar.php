<?php require RUTA_APP . '/vista/inc/header.php';
require_once RUTA_APP. '/helpers/validaSesion.php';
	
	if ($_SESSION['RolUsuario'] == 2) {

	}else{
		redireccionar('peliculas');
	}
?>

<div class="card card-body fondo mt-5">
	<h2>Modificar Peliculas</h2>
	<form action="<?php echo RUTA_URL; ?>peliculas/editar/<?php echo $datos['id_pelicula'];?>"method="POST" enctype="multipart/form-data">

		<div class="contenedor-pelicula">
			<img class="miniatura" src="<?php echo RUTA_URL.'public/img/'.$datos['miniatura']; ?>">
		</div>

		<div class="form-group">
			<label for="nombre">Nombre: <sup>*</sup></label>
			<input type="text" name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
		</div>
		<div class="form-group">
			<label for="fecha_est">Fecha de estreno: <sup>*</sup></label>
			<input type="text" name="fecha_est" class="form-control form-control-lg" value="<?php echo $datos['fecha_est']; ?>">
		</div>
		<div class="form-group">
			<label for="fk_genero">Generos: <sup>*</sup></label>
			<select name='fk_genero'>
				<?php
				foreach ($datos['generos'] as $genero) {

					if ($datos['fk_genero'] == $genero->id_genero) {
						echo "<option value='".$genero->id_genero."' selected>".$genero->genero."</option>";	
					}else{
					echo "<option value='".$genero->id_genero."'>".$genero->genero."</option>";
					}
				}
				
				?>
				</select>
			
		</div>
		
		<div class="form-group">
			<label for="miniatura">Miniatura: <sup>*</sup></label>
			<input type="file" name="miniatura"  class="btn btn-lg">
		</div>

		<div class="form-group">
			<label for="reparto">Reparto: <sup>*</sup></label>
			<input type="text" name="reparto" class="form-control form-control-lg" value="<?php echo $datos['reparto']; ?>">
		</div>
		<div class="form-group">
			<label for="sinopsis">Sinopsis: <sup>*</sup></label>
			<input type="text" name="sinopsis" class="form-control form-control-lg" value="<?php echo $datos['sinopsis']; ?>">
		</div>
		<div class="form-group">
			<label for="servidor1">Servidor1: <sup>*</sup></label>
			<input type="text" name="servidor1" class="form-control form-control-lg" value="<?php echo $datos['servidor1']; ?>">
		</div>
		<div class="form-group">
			<label for="servidor2">Servidor2: <sup>*</sup></label>
			<input type="text" name="servidor2" class="form-control form-control-lg" value="<?php echo $datos['servidor1']; ?>">
		</div>
		<div class="form-group">
			<label for="servidor3">Servidor3: <sup>*</sup></label>
			<input type="text" name="servidor3" class="form-control form-control-lg" value="<?php echo $datos['servidor3']; ?>">
		</div>
		<div class="form-group">
			<label for="url_trailer">URL Trailer: <sup>*</sup></label>
			<input type="text" name="url_trailer" class="form-control form-control-lg" value="<?php echo $datos['url_trailer']; ?>">
		</div>

		<div class="form-group">
			<label for="status">Estado: <sup>*</sup></label><br>
			<?php
			if ($datos['status'] == 1) {
				echo "<input type='radio' name='status' value='1' checked>Activa<br>";
				echo "<input type='radio' name='status' value='0'>Inactiva";
			}else{
				echo "<input type='radio' name='status' value='1' >Activa<br>";
				echo "<input type='radio' name='status' value='0' checked>Inactiva";
			}
			?>
		</div>

		<input type="submit" class="btn btn-success" value="Modificar Pelicula">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
