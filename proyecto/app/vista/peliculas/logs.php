<?php require RUTA_APP . '/vista/inc/header.php'?>
	<table class="table table-dark tabla l">
		<th>Usuario</th>
		<th>Fecha</th>
		<th>Accion</th>

		<?php
		foreach ($datos['registros'] as $log) {
			echo "<tr>";
			echo "<td>".$log->usuario."</td>";
			echo "<td>".$log->fecha."</td>";
			echo "<td>".base64_decode($log->accion)."</td>";
		}

		?>
	
	</table>


<?php require RUTA_APP . '/vista/inc/footer.php'?>