<?php

	class Peliculas extends Controlador{

		public function __construct(){
			$this->peliculaModelo = $this->modelo('Pelicula');
		}

		public function index(){

			//Obtener las peliculas

			$peliculas = $this->peliculaModelo->getPeliculas();

			$datos = [
				'peliculas' => $peliculas
			];
			
			$this->vista('peliculas/inicio', $datos);
		}

		public function agregar(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$datos = [
					'nombre' => trim($_POST['nombre']),
					'fecha_est' => trim($_POST['fecha_est']),
					'fk_genero' => trim($_POST['fk_genero']),
					'miniatura' => trim($_FILES['miniatura']['name']),
					'reparto' => trim($_POST['reparto']),
					'sinopsis' => trim($_POST['sinopsis']),
					'servidor1' => trim($_POST['servidor1']),
					'servidor2' => trim($_POST['servidor2']),
					'servidor3' => trim($_POST['servidor3']),
					'url_trailer' => trim($_POST['url_trailer']),
					'status' => trim($_POST['status'])
				];
						if ($this->peliculaModelo->agregarPelicula($datos)) {
							redireccionar('peliculas');
							}else{
								die('Algo salio mal');
							}	



				}else{
					$generos = $this->peliculaModelo->getGeneros();

					$datos = [
						'nombre' => '',
						'fecha_est' => '',
						'fk_genero' => '',
						'miniatura' => '',
						'reparto' => '',
						'sinopsis' => '',
						'servidor1' => '',
						'servidor2' => '',
						'servidor3' => '',
						'url_trailer' => '',
						'generos' => $generos
					];
					$this->vista('peliculas/agregar', $datos);

			}
		}


		public function editar($id){

			//Obtener informacion de la pelicula por ID
			$pelicula = $this->peliculaModelo->getPelicula($id);
			$generos = $this->peliculaModelo->getGeneros();

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				unlink($_SERVER['DOCUMENT_ROOT'].'/proyecto/public/img/'.$pelicula->miniatura);
				
				$datos = [
					'id_pelicula' => $id,
					'nombre' => trim($_POST['nombre']),
					'fecha_est' => trim($_POST['fecha_est']),
					'fk_genero' => trim($_POST['fk_genero']),
					'miniatura' => trim($_FILES['miniatura']['name']),
					'reparto' => trim($_POST['reparto']),
					'sinopsis' => trim($_POST['sinopsis']),
					'servidor1' => trim($_POST['servidor1']),
					'servidor2' => trim($_POST['servidor2']),
					'servidor3' => trim($_POST['servidor3']),
					'url_trailer' => trim($_POST['url_trailer']),
					'status' => trim($_POST['status'])
				];
				

				if ($this->peliculaModelo->actualizarPelicula($datos)) {
					redireccionar('peliculas');
				}else{
					die('Algo salio mal');
					}

				}else{
					

				$datos = [
					'id_pelicula' => $pelicula->id_pelicula,
					'fk_genero' => $pelicula->fk_genero,
					'nombre' => $pelicula->nombre,
					'fecha_est' => $pelicula->fecha_est,
					'miniatura' => $pelicula->miniatura,
					'reparto' =>  $pelicula->reparto,
					'sinopsis' => $pelicula->sinopsis,
					'servidor1' => $pelicula->servidor1,
					'servidor2' => $pelicula->servidor3,
					'servidor3' => $pelicula->servidor2,
					'url_trailer' =>  $pelicula->url_trailer,
					'generos' => $generos,
					'status' => $pelicula->status
				];

					$this->vista('peliculas/editar', $datos);
		}
	}

	public function eliminar($id){

			$pelicula = $this->peliculaModelo->getPelicula($id);

				$datos = [
					'id_pelicula' => $pelicula->id_pelicula,
					'nombre' => $pelicula->nombre,
					'fecha_est' => $pelicula->fecha_est,
					'fk_genero' => $pelicula->fk_genero,
					'miniatura' => $pelicula->miniatura,
					'reparto' =>  $pelicula->reparto,
					'sinopsis' => $pelicula->sinopsis,
					'servidor1' => $pelicula->servidor1,
					'servidor2' => $pelicula->servidor3,
					'servidor3' => $pelicula->servidor2,
					'url_trailer' =>  $pelicula->url_trailer
				];

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$datos = [
					'id_pelicula' => $id
				];

				if ($this->peliculaModelo->eliminarPelicula($datos)) {
					redireccionar('peliculas');
				}else{
					die('Algo salio mal');
					}

				}
					$this->vista('peliculas/eliminar', $datos);
		}





		public function visualizar($id){
			$pelicula = $this->peliculaModelo->getPelicula($id);
			$generos = $this->peliculaModelo->getGeneros();

				$datos = [
					'id_pelicula' => $pelicula->id_pelicula,
					'fk_genero' => $pelicula->fk_genero,
					'nombre' => $pelicula->nombre,
					'fecha_est' => $pelicula->fecha_est,
					'miniatura' => $pelicula->miniatura,
					'reparto' =>  $pelicula->reparto,
					'sinopsis' => $pelicula->sinopsis,
					'servidor1' => $pelicula->servidor1,
					'servidor2' => $pelicula->servidor3,
					'servidor3' => $pelicula->servidor2,
					'url_trailer' =>  $pelicula->url_trailer,
					'generos' => $generos,
					'status' => $pelicula->status
				];

			$this->vista('peliculas/reproductor', $datos);
		}

		public function filtroGenero($id){
			$porGenero = $this->peliculaModelo->filtroGenero($id);

			$datos = [
				'porGenero' => $porGenero
			];

			$this->vista('peliculas/porGenero', $datos);
		}


		public function filtroBusqueda(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$busqueda = trim($_POST['buscar']);
				$filtro = $this->peliculaModelo->filtroBusqueda($busqueda);

				$datos = [
					'busqueda' => $filtro
				];

				$this->vista('peliculas/busqueda',$datos);
			}

		}

		public function peliculasInactivas(){

			$peliculas = $this->peliculaModelo->peliculasInactivas();

			$datos = [
				'inactivas' => $peliculas
			];
			
			$this->vista('peliculas/inactivas', $datos);
		}

		public function logs(){
			
			$registros = $this->peliculaModelo->getLogs();

			$datos = [
				'registros' => $registros
			];

			$this->vista('peliculas/logs', $datos);
		}
	}

?>