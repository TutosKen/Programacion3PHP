<?php
if (isset($_SESSION['clavetmp'])) {
	echo "<div class='alert alert-primary alerta' role='alert'>";
  	echo $_SESSION['clavetmp'];
	echo "</div>";
	unset($_SESSION['clavetmp']);
}

?>

<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">

<div class="card card-body fondo1 mt-5">
	<h2>Inicio de Sesión</h2>
	<form action="<?php echo RUTA_URL; ?>usuarios/validar" method="POST">

		<div class="form-group">
			<label for="username">Nombre de Usuario: <sup>*</sup></label>
			<input type="text" name="username" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="passwd">Contraseña: <sup>*</sup></label>
			<input type="password" name="passwd" class="form-control form-control-lg">
		</div>

		<h5>No tienes cuenta?  <a href="<?php echo RUTA_URL;?>usuarios/registro">Registrate ahora</a></h5>

		<?php

		if (isset($_SESSION['errorflash'])){
			echo "<div class='alert alert-danger' role='alert'>";
			echo "<h5>".$_SESSION['errorflash']."</h5><br>";
			unset($_SESSION['errorflash']);
			echo "</div>";
		}

		?>


		<input type="submit" class="btn btn-success" value="Iniciar Sesión">
		
	</form>
	
</div>
<?php require RUTA_APP . '/vista/inc/footer.php'?>
