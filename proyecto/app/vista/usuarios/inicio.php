<?php require RUTA_APP . '/vista/inc/header.php'?>
	<table class="table table-dark tabla u">
		<th>ID de Usuario</th>
		<th>Nombre de Usuario</th>
		<th>Contraseña</th>
		<th>Rol</th>
		<th>Acciones</th>

		<?php
		foreach ($datos['usuarios'] as $usuario) {
			echo "<tr>";
			echo "<td>".$usuario->id_usuario."</td>";
			echo "<td>".$usuario->nombre_usuario."</td>";
			echo "<td>".$usuario->pass."</td>";
			if ($usuario->rol == 1) {
				echo "<td>Usuario cliente</td>";
			}else{
				echo "<td>Administrador</td>";
			}
			echo "<td><a href='".RUTA_URL."usuarios/editar/".$usuario->id_usuario."'><button class='btn btn-sm btn-primary'>Editar</button></a></td>";
			echo "<td><a href='".RUTA_URL."usuarios/eliminar/".$usuario->id_usuario."'><button class='btn btn-sm btn-primary'>Eliminar</button></a></td>";
		}

		?>
	
	</table>


<?php require RUTA_APP . '/vista/inc/footer.php'?>