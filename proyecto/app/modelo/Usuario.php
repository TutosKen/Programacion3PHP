<?php
session_start();
date_default_timezone_set('America/Costa_Rica');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../app/PHPMailer/Exception.php';
require '../app/PHPMailer/PHPMailer.php';
require '../app/PHPMailer/SMTP.php';
	
	class Usuario{
		private $db;

		public function __construct(){
			$this->db = new Base();
		}

		public function getUsuarios(){
			$this->db->sentencia("SELECT * FROM usuarios");
			$resultados = $this->db->getRegistros();
			return $resultados;
		}

		public function getUsuario($id){
			$this->db->sentencia("SELECT * FROM usuarios where id_usuario = :id");
			$this->db->vincular(':id', $id);
			$fila = $this->db->getRegistro();
			return $fila;
		}

		public function agregarUsuario($datos){
			$this->db->sentencia('INSERT INTO usuarios (nombre_usuario, pass, rol,email) VALUES (:nombre_usuario, :pass, :rol, :email)');

			//Vinculamos los valores
			$this->db->vincular(':nombre_usuario',$datos['nombre_usuario']);
			$this->db->vincular(':pass',hash('md5',$datos['pass']));
			$this->db->vincular(':rol',$datos['rol']);
			$this->db->vincular(':email',$datos['email']);


			foreach ($datos['usuarios'] as $user) {
				if ($user->nombre_usuario != $datos['nombre_usuario']) {
					$this->db->ejecutar();
					$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("INSERT INTO usuarios (nombre_usuario,pass,rol,email) VALUES (".$datos['nombre_usuario'].",".$datos['pass'].",".$datos['rol'].",".$datos['email'].")")."')");
				$this->db->ejecutar();
				return true;
				}else{
					return false;
				}
			}
		}

		public function actualizarUsuario($datos){
			$this->db->sentencia('UPDATE usuarios SET nombre_usuario = :nombre_usuario, pass = :pass, rol = :rol, email = :email where id_usuario = :id');

			//Vinculamos los valores
			$this->db->vincular(':id',$datos['id_usuario']);
			$this->db->vincular(':nombre_usuario',$datos['nombre_usuario']);
			$this->db->vincular(':pass', hash('md5',$datos['pass']));
			$this->db->vincular(':rol',$datos['rol']);
			$this->db->vincular(':email',$datos['email']);

			//Ejecutar
			if ($this->db->ejecutar()) {
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("UPDATE usuarios SET nombre_usuario = ".$datos['nombre_usuario'].", pass = ".$datos['pass'].", rol = ".$datos['rol'].", email = ".$datos['email']." ")."')");
				$this->db->ejecutar();
				return true;
			}else{
				return false;
			}
		}

		public function eliminarUsuario($datos){
			$this->db->sentencia('DELETE FROM usuarios where id_usuario = :id');

			//Vinculamos los valores
			$this->db->vincular(':id',$datos['id_usuario']);

			//Ejecutar
			if ($this->db->ejecutar()) {
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("DELETE FROM usuarios WHERE id_usuario ".$datos['id_usuario']." ")."') ");
				$this->db->ejecutar();
				return true;
			}else{
				return false;
			}
		}

		public function validarDatos($datos){
			$this->db->sentencia('SELECT nombre_usuario, pass, rol, id_usuario FROM usuarios where nombre_usuario = :username AND pass = :pass');

			//Vinculamos los valores
			$this->db->vincular(':username',$datos['username']);
			$this->db->vincular(':pass',hash('md5',$datos['pass']));

			if ($this->db->ejecutar()) {
				if ($this->db->getFilas()) {
					$user = $this->db->getRegistro();
					$_SESSION['RolUsuario'] =  $user->rol;
					$_SESSION['UserName'] = $user->nombre_usuario;
					$_SESSION['password'] = $user->pass;
					$_SESSION['IDU'] = $user->id_usuario;

				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("SELECT nombre_usuario, pass, rol, id_usuario FROM usuarios WHERE nombre_usuario = ".$datos['username']." AND pass = ".$datos['pass']."")."') ");
				$this->db->ejecutar();
					return true;
				}else{
					return false;
				}
			}

		}

		public function registroUsuario($datos){
			$claveTmp = $this->generarRandomString();
			$_SESSION['clavetmp'] = "Bienvenido! Tu clave temporal es: ". $claveTmp. " Usala para iniciar sesión";

			$this->db->sentencia('INSERT INTO usuarios (nombre_usuario, pass, email) VALUES (:nombre_usuario, :pass, :email)');

				//Vinculamos los valores
			$this->db->vincular(':nombre_usuario',$datos['nombre_usuario']);
			$this->db->vincular(':pass',hash('md5', $claveTmp));
			$this->db->vincular(':email',$datos['email']);
			

			foreach ($datos['usuarios'] as $user) {
				if ($user->nombre_usuario != $datos['nombre_usuario']) {
					$this->db->ejecutar();
					$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("INSERT INTO usuarios (nombre_usuario,pass,email) VALUES (".$datos['nombre_usuario'].",".$datos['pass'].",".$datos['email'].")")."')");
				$this->db->ejecutar();
				return true;
				}else{
					return false;
				}
			}

		}

		public function logOut(){
			if (isset($_SESSION['RolUsuario']) && isset($_SESSION['UserName'])) {
				unset($_SESSION['RolUsuario']);
				unset($_SESSION['UserName']);
				return true;
			}else{
				return false;
			}
		}


		function generarRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
		}


		public function cambiarClave($datos){
			if (hash('md5',$datos['clave_actual']) == $_SESSION['password']) {

				if ($datos['clave_nueva'] == $datos['conf_clave_nueva']) {
					$this->db->sentencia('UPDATE usuarios set pass = :pass where id_usuario = :id');
					$this->db->vincular(':id',$_SESSION['IDU']);
					$this->db->vincular(':pass',hash('md5', $datos['clave_nueva']));
					$this->db->ejecutar();
				$this->db->sentencia("INSERT INTO logs(usuario,fecha,accion) VALUES('".$_SESSION['UserName']."','".date('Y-m-d H:i:s')."','".base64_encode("UPDATE usuarios SET pass = ".$datos['clave_nueva']." WHERE id_usuario = ".$_SESSION['IDU']."")."')");
				$this->db->ejecutar();
					return true;
			}else{
				$_SESSION['errorClaveNew'] = "La contraseña nueva no coincide";	
				return false;
			}

		}else{
			$_SESSION['errorClaveAct'] = "La contraseña actual no coincide";
			return false;
		}
	}
}


?>