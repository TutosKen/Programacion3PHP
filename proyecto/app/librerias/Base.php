<?php
	
	//Clase para conectarse a la base de datos y ejecutar consultas
	class Base{
		private $host = DB_HOST;
		private $usuario = DB_USUARIO;
		private $password = DB_PASSWORD;
		private $nombre_base = DB_NOMBRE;

		private $dbh;
		private $stmt;
		private $error;

		public function __construct(){
			//Configurar conexion
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nombre_base;
			$opciones = array(
				PDO::ATTR_PERSISTENT => TRUE,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

			//Crear una instancia de PDO
			try {
				$this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
				$this->dbh->exec('set names utf8');

			} catch (PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
				
			}
		}

		//Preparamos la consulta
		public function sentencia($sql){
			$this->stmt = $this->dbh->prepare($sql);
		}

		//Vinculamos la consulta
		public function vincular($parametro, $valor, $tipo = null){
			if (is_null($tipo)) {
				switch (true) {
					case is_int($valor):
						$tipo = PDO::PARAM_INT;
						break;
					
					case is_bool($valor):
						$tipo = PDO::PARAM_BOOL;
						break;

					case is_string($valor):
						$tipo = PDO::PARAM_STR;
						break;
						

					default:
						$tipo = PDO::PARAM_NULL;
						break;
				}
			}
			$this->stmt->bindValue($parametro, $valor, $tipo);

		}


		//Ejecuta la consulta
		public function ejecutar(){
			return $this->stmt->execute();
		}

		//Obtener los registros de la consulta
		public function getRegistros(){
			$this->ejecutar();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		//Obtener un solo registro
		public function getRegistro(){
			$this->ejecutar();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		//Obtener la cantidad de filas
		public function getFilas(){
			return $this->stmt->rowCount();
		}

	}

?>