<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">

<div class="card card-body mt-5 fondo">
	<h2>Agregar Usuario</h2>
	<form action="<?php echo RUTA_URL; ?>usuarios/registro" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nombre_usuario">Nombre de usuario: <sup>*</sup></label>
			<input type="text" name="nombre_usuario" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="email">Email: <sup>*</sup></label>
			<input type="email" name="email" class="form-control form-control-lg">
		</div>

		<input type="submit" class="btn btn-success" value="Agregar Usuario">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
