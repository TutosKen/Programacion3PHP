<?php
//Funcion para hacer redireccionamiento

function redireccionar($pagina){
	header('location: '.RUTA_URL.$pagina);
}

?>