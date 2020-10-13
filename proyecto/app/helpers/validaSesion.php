<?php
if (isset($_SESSION['RolUsuario'])) {
}else{
	redireccionar('usuarios/validar');
}
?>