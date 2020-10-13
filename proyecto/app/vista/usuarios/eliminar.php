<?php require RUTA_APP . '/vista/inc/header.php';
require_once RUTA_APP. '/helpers/validaSesion.php';
	
	if ($_SESSION['RolUsuario'] == 2) {

	}else{
		redireccionar('peliculas');
	}
?>
<div class="card card-body mt-5 fondo">
	<h2>Agregar Usuario</h2>
	<form action="<?php echo RUTA_URL; ?>usuarios/eliminar/<?php echo $datos['id_usuario'];?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nombre_usuario">Nombre de usuario: <sup>*</sup></label>
			<input type="text" readonly name="nombre_usuario" class="form-control form-control-lg" value="<?php echo $datos['nombre_usuario']?>">
		</div>

		<div class="form-group">
			<label for="rol">Rol: <sup>*</sup></label><br>
			<?php
			if ($datos['rol'] == 1) {
				echo "<input type='radio' name='rol' checked>Usuario Cliente<br>";
				echo "<input type='radio' name='rol'>Administrador";
			}else{
				echo "<input type='radio' name='rol'>Usuario Cliente<br>";
				echo "<input type='radio' name='rol' checked>Administrador";
			}
			?>
		</div>

		<input type="submit" class="btn btn-danger" value="Eliminar Usuario">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
