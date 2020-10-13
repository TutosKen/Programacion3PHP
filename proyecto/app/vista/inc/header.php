<?php session_start();
$tiempo = $_SERVER['REQUEST_TIME'];
$timeout = 300;

if (isset($_SESSION['LAST_ACTIVITY']) && ($tiempo - $_SESSION['LAST_ACTIVITY']) > $timeout) {
  unset($_SESSION['RolUsuario']);
  unset($_SESSION['UserName']);
}

$_SESSION['LAST_ACTIVITY'] = $tiempo;
date_default_timezone_set('America/Costa_Rica');
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device=width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="id=edge">
  <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">
	<title><?php echo NOMBRESITIO; ?></title>
</head>
<body>

<?php
  require_once RUTA_APP. '/helpers/validaSesion.php';
    if ($_SESSION['RolUsuario'] == 2) {
?>
	<!--Inicio barra de navegacion-->
<nav class="navbar navbar-expand-lg barraAdmin">
        <a class="navbar-brand" href="<?php echo RUTA_URL?>"><img src="<?php echo RUTA_URL;?>public/img/logo.png">Cuevana 4</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="btn btn-primary btn-sm">Desplegar</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

        <li class="nav-item dropdown estiloli">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['UserName']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/logs">Logs</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>usuarios">Lista Usuarios</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/peliculasInactivas">Peliculas Inactivas</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/agregar">Agregar Pelicula</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>usuarios/agregar">Agregar Usuario</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>usuarios/changePass">Cambiar Clave</a>
          <br>
          <center>
          <form method="POST" action="<?php echo RUTA_URL;?>usuarios/cerrar_sesion">
          <input type="submit" class="btn btn-sm btn-danger" name="logout" value="Cerrar Sesión">
          </form>
          </center>

        </div>
        </li>

      <li class="nav-item estiloli">
        <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown estiloli">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Generos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/1">Accion</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/2">Ciencia Ficcion</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/3">Comedia</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/4">Romance</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/5">Drama</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/6">Comedia-Romantica</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/7">Terror</a>
        </div>
        </li>

    </ul>
    <form class="form-inline my-2 my-lg-0 ml-auto" action="<?php echo RUTA_URL?>peliculas/filtroBusqueda" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" name="buscar" aria-label="Buscar">
      <button class="btn btn-outline-success my-2 my-sm-0 ml-3" type="submit">Buscar</button>
    </form>
  </div>
</nav>


<?php
}else{
?>


  <!--Inicio barra de navegacion-->
<nav class="navbar navbar-expand-lg barra">
        <a class="navbar-brand" href="<?php echo RUTA_URL?>"><img src="<?php echo RUTA_URL;?>public/img/logo.png">Cuevana 4</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="btn btn-primary btn-sm">Desplegar</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown estiloli">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['UserName']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="usuarios/changePass">Cambiar Clave</a>
          <br>
          <center>
          <form method="POST" action="<?php echo RUTA_URL;?>usuarios/cerrar_sesion">
          <input type="submit" class="btn btn-sm btn-danger" name="logout" value="Cerrar Sesión">
          </form>
          </center>

        </div>
        </li>

      <li class="nav-item estiloli">
        <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown estiloli">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Generos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/1">Accion</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/2">Ciencia Ficcion</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/3">Comedia</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/4">Romance</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/5">Drama</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/6">Comedia-Romantica</a>
          <a class="dropdown-item" href="<?php echo RUTA_URL?>peliculas/filtroGenero/7">Terror</a>
        </div>
        </li>

    </ul>
    <form class="form-inline my-2 my-lg-0 ml-auto" action="<?php echo RUTA_URL?>peliculas/filtroBusqueda" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" name="buscar" aria-label="Buscar">
      <button class="btn btn-outline-success my-2 my-sm-0 ml-3" type="submit">Buscar</button>
    </form>
  </div>
</nav>

<?php
  }
?>


<!--Fin barra de navegacion-->

  