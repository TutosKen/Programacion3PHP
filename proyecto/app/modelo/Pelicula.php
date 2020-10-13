<?php
	session_start();
	date_default_timezone_set('America/Costa_Rica');
	class Pelicula{
		private $db;

		public function __construct(){
			$this->db = new Base();
		}

		public function getLogs(){
			$this->db->sentencia("SELECT * FROM logs");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}
		
		public function getPeliculas(){
			$this->db->sentencia("SELECT * FROM pelicula where status = 1");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}

		public function getGeneros(){
			$this->db->sentencia("SELECT * FROM generos");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}

		public function getPelicula($id){
			$this->db->sentencia("SELECT * FROM pelicula where id_pelicula = :id");
			$this->db->vincular(':id', $id);
			$fila = $this->db->getRegistro();
			return $fila;
		}

		public function filtroGenero($id){
			$this->db->sentencia("SELECT * FROM pelicula WHERE fk_genero = :id AND status = 1");
			$this->db->vincular(':id',$id);
			$resultados = $this->db->getRegistros();
			return $resultados;

		}

		public function filtroBusqueda($busqueda){
			$this->db->sentencia("SELECT * FROM pelicula WHERE nombre LIKE '%$busqueda%' AND status = 1");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}

		public function peliculasInactivas(){
			$this->db->sentencia("SELECT * FROM pelicula WHERE status = 0");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}

		public function agregarPelicula($datos){

			$tamanio = $_FILES['miniatura']['size'];
			$tipo_imagen = $_FILES['miniatura']['type'];
			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/proyecto/public/img/';
			$nombre = $_FILES['miniatura']['name'];
			
			move_uploaded_file($_FILES['miniatura']['tmp_name'], $carpeta_destino.$nombre);

			$this->db->sentencia('INSERT INTO pelicula (nombre, fecha_est, fk_genero, miniatura, reparto, sinopsis, servidor1, servidor2, servidor3, url_trailer, status) VALUES (:nombre, :fecha_est, :fk_genero, :miniatura, :reparto, :sinopsis, :servidor1, :servidor2, :servidor3, :url_trailer, :status)');

			//Vinculamos los valores
			$this->db->vincular(':nombre',$datos['nombre']);
			$this->db->vincular(':fecha_est',$datos['fecha_est']);
			$this->db->vincular(':fk_genero',$datos['fk_genero']);
			$this->db->vincular(':miniatura',$datos['miniatura']);
			$this->db->vincular(':reparto',$datos['reparto']);
			$this->db->vincular(':sinopsis',$datos['sinopsis']);
			$this->db->vincular(':servidor1',$datos['servidor1']);
			$this->db->vincular(':servidor2',$datos['servidor2']);
			$this->db->vincular(':servidor3',$datos['servidor3']);
			$this->db->vincular(':url_trailer',$datos['url_trailer']);
			$this->db->vincular(':status',$datos['status']);

			//Ejecutar
			if ($this->db->ejecutar()) {
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("INSERT INTO pelicula (nombre, fecha_est, fk_genero, miniatura, reparto, sinopsis, servidor1, servidor2, servidor3, url_trailer, status) VALUES (".$datos['nombre'].",".$datos['fecha_est'].",".$datos['fk_genero'].",".$datos['miniatura'].",".$datos['reparto'].",".$datos['sinopsis'].",".$datos['servidor1'].",".$datos['servidor2'].",".$datos['servidor3'].",".$datos['url_trailer'].",".$datos['status'].")")."')");
				$this->db->ejecutar();
				return true;
			}else{
				return false;
			}
		}

		public function actualizarPelicula($datos){

			$tamanio = $_FILES['miniatura']['size'];
			$tipo_imagen = $_FILES['miniatura']['type'];
			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/proyecto/public/img/';
			$nombre = $_FILES['miniatura']['name'];
			
			
			move_uploaded_file($_FILES['miniatura']['tmp_name'], $carpeta_destino.$nombre);

			$this->db->sentencia('UPDATE pelicula SET nombre = :nombre, fecha_est = :fecha_est, fk_genero = :fk_genero, miniatura = :miniatura, reparto = :reparto, sinopsis = :sinopsis, servidor1 = :servidor1, servidor2 = :servidor2, servidor3 = :servidor3, url_trailer = :url_trailer, status = :status WHERE id_pelicula = :id');

			//Vinculamos los valores
			$this->db->vincular(':id',$datos['id_pelicula']);
			$this->db->vincular(':nombre',$datos['nombre']);
			$this->db->vincular(':fecha_est',$datos['fecha_est']);
			$this->db->vincular(':fk_genero',$datos['fk_genero']);
			$this->db->vincular(':miniatura',$datos['miniatura']);
			$this->db->vincular(':reparto',$datos['reparto']);
			$this->db->vincular(':sinopsis',$datos['sinopsis']);
			$this->db->vincular(':servidor1',$datos['servidor1']);
			$this->db->vincular(':servidor2',$datos['servidor2']);
			$this->db->vincular(':servidor3',$datos['servidor3']);
			$this->db->vincular(':url_trailer',$datos['url_trailer']);
			$this->db->vincular(':status',$datos['status']);

			//Ejecutar
			if ($this->db->ejecutar()) {
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("UPDATE pelicula SET nombre = ".$datos['nombre'].", fecha_est = ".$datos['fecha_est'].", fk_genero = ".$datos['fk_genero'].", miniatura = ".$datos['miniatura'].", reparto = ".$datos['reparto'].", sinopsis = ".$datos['sinopsis'].", servidor1 = ".$datos['servidor1'].", servidor2 = ".$datos['servidor2'].", servidor3 = ".$datos['servidor3'].", url_trailer = ".$datos['url_trailer'].", status = ".$datos['status']." WHERE id_pelicula = ".$datos['id_pelicula']."")."')");
				$this->db->ejecutar();
				return true;
			}else{
				return false;
			}
		}

		public function eliminarPelicula($datos){
			$this->db->sentencia('UPDATE pelicula set status = 0 where id_pelicula = :id');

			//Vinculamos los valores
			$this->db->vincular(':id',$datos['id_pelicula']);


			//Ejecutar
			if ($this->db->ejecutar()) {
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("UPDATE pelicula SET status = 0 WHERE id_pelicula = ".$datos['id_pelicula']."")."')");
				$this->db->ejecutar();
				return true;
			}else{
				return false;
			}
		}
	}


?>