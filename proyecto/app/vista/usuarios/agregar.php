<?php require RUTA_APP . '/vista/inc/header.php';
require_once RUTA_APP. '/helpers/validaSesion.php';
	
	if ($_SESSION['RolUsuario'] == 2) {

	}else{
		redireccionar('peliculas');
	}
?>
<div class="card card-body mt-5 fondo">
	<h2>Agregar Usuario</h2>
	<form action="<?php echo RUTA_URL; ?>usuarios/agregar" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nombre_usuario">Nombre de usuario: <sup>*</sup></label>
			<input type="text" name="nombre_usuario" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="pass">Contraseña <sup>*</sup></label>
			<input type="password" name="pass" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="rol">Rol: <sup>*</sup></label><br>
			<input type="radio" name="rol" value="1">Usuario Cliente<br>
			<input type="radio" name="rol" value="2">Administrador
		</div>

		<div class="form-group">
			<label for="email">Email <sup>*</sup></label>
			<input type="email" name="email" class="form-control form-control-lg">
		</div>

		<?php
			if (isset($_SESSION['usuarioEx'])) {
			echo "<div class='alert alert-danger' role='alert'>";
			echo "<h5>".$_SESSION['usuarioEx']."</h5><br>";
			unset($_SESSION['usuarioEx']);
			echo "</div>";
		}
		?>

		<input type="submit" class="btn btn-success" value="Agregar Usuario">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
