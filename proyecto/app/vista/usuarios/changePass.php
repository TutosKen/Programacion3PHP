<?php require RUTA_APP . '/vista/inc/header.php'?>

<div class="card card-body fondo mt-5">
	<h2>Cambiar clave</h2>

	<form action="<?php echo RUTA_URL; ?>usuarios/changePass" method="POST">

		<div class="form-group">
			<label for="clave_actual">Clave Actual: <sup>*</sup></label>
			<input type="password" name="clave_actual" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="clave_nueva">Clave nueva: <sup>*</sup></label>
			<input type="password" name="clave_nueva" class="form-control form-control-lg">
		</div>

		<div class="form-group">
			<label for="conf_clave_nueva">Confirmar clave nueva: <sup>*</sup></label>
			<input type="password" name="conf_clave_nueva" class="form-control form-control-lg">
		</div>
<?php

if (isset($_SESSION['errorClaveAct'])){
			echo "<div class='alert alert-danger' role='alert'>";
			echo "<h5>".$_SESSION['errorClaveAct']."</h5><br>";
			unset($_SESSION['errorClaveAct']);
			echo "</div>";

		}else if(isset($_SESSION['errorClaveNew'])){
			echo "<div class='alert alert-danger' role='alert'>";
			echo "<h5>".$_SESSION['errorClaveNew']."</h5><br>";
			unset($_SESSION['errorClaveNew']);
			echo "</div>";
		}
?>
		<input type="submit" class="btn btn-success" value="Confirmar">
		
	</form>
	
</div>