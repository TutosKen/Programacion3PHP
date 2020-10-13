<?php require RUTA_APP . '/vista/inc/header.php';
require_once RUTA_APP. '/helpers/validaSesion.php';
	
	if ($_SESSION['RolUsuario'] == 2) {

	}else{
		redireccionar('peliculas');
	}
?>
<div class="card card-body fondo mt-5">
	<h2>Eliminar Peliculas</h2>
	<form action="<?php echo RUTA_URL; ?>/peliculas/eliminar/<?php echo $datos['id_pelicula'];?>" method="POST">

		<div class="contenedor-pelicula">
			<img class="miniatura"	 src="<?php echo RUTA_URL.'public/img/'.$datos['miniatura']; ?>">
		</div>
		<div class="form-group">
			<label for="nombre">Nombre: <sup>*</sup></label>
			<input type="text" readonly name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
		</div>
		<div class="form-group">
			<label for="fecha_est">Fecha de estreno: <sup>*</sup></label>
			<input type="text" readonly name="fecha_est" class="form-control form-control-lg" value="<?php echo $datos['fecha_est']; ?>">
		</div>
		<div class="form-group">
			<label for="sinopsis">Sinopsis: <sup>*</sup></label>
			<textarea readonly name="sinopsis" class="form-control form-control-lg"><?php echo $datos['sinopsis']; ?></textarea>

		<br><input type="submit" class="btn btn-danger" value="Eliminar Pelicula">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
