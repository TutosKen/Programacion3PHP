<?php
session_start();

	class Usuarios extends Controlador{

		public function __construct(){
			$this->usuarioModelo = $this->modelo('Usuario');
		}

		public function index(){

			//Obtener los usuarios

			$usuarios = $this->usuarioModelo->getUsuarios();

			$datos = [
				'usuarios' => $usuarios

			];
			
			$this->vista('usuarios/inicio', $datos);
		}

		public function agregar(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$usuarios = $this->usuarioModelo->getUsuarios();

				$datos = [
					'nombre_usuario' => trim($_POST['nombre_usuario']),
					'pass' => trim($_POST['pass']),
					'rol' => trim($_POST['rol']),
					'email' => trim($_POST['email']),
					'usuarios' => $usuarios
				];

						if ($this->usuarioModelo->agregarUsuario($datos)) {
							redireccionar('usuarios');
							}else{
								$_SESSION['usuarioEx'] = "El nombre de usuario se encuentra en uso";
								redireccionar('usuarios/agregar');
							}	



				}else{
					$datos = [
						'nombre_usuario' => '',
						'pass' => '',
						'rol' => '',
						'email' => ''
					];

					$this->vista('usuarios/agregar', $datos);

			}
		}


		public function editar($id){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$datos = [
					'id_usuario' => $id,
					'nombre_usuario' => trim($_POST['nombre_usuario']),
					'pass' => trim($_POST['pass']),
					'rol' => trim($_POST['rol']),
					'email' => trim($_POST['email'])
				];

				if ($this->usuarioModelo->actualizarUsuario($datos)) {
					redireccionar('usuarios');
				}else{
					die('Algo salio mal');
					}

				}else{
					
					//Obtener informacion del usuario por ID
					$usuario = $this->usuarioModelo->getUsuario($id);

				$datos = [
					'id_usuario' => $usuario->id_usuario,
					'nombre_usuario' => $usuario->nombre_usuario,
					'pass' => $usuario->pass,
					'rol' => $usuario->rol,
					'email' => $usuario->email
				];

					$this->vista('usuarios/editar', $datos);
		}
	}

	public function eliminar($id){

			$usuario = $this->usuarioModelo->getUsuario($id);

				$datos = [
					'id_usuario' => $usuario->id_usuario,
					'nombre_usuario' => $usuario->nombre_usuario,
					'rol' => $usuario->rol
				];

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$datos = [
					'id_usuario' => $id
				];

				if ($this->usuarioModelo->eliminarUsuario($datos)) {
					redireccionar('usuarios');
				}else{
					die('Algo salio mal');
					}

				}
					$this->vista('usuarios/eliminar', $datos);
		}


		public function validar(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$datos = [
					'username' => trim($_POST['username']),
					'pass' => trim($_POST['passwd'])
				];

						if ($this->usuarioModelo->validarDatos($datos)) {
							redireccionar('peliculas');
							}else{
								$_SESSION['errorflash'] = "Datos Incorrectos";
								redireccionar('usuarios/validar');
							}	



				}else{
					$datos = [
						'username' => '',
						'passwd' => ''
					];

					$this->vista('usuarios/validar', $datos);

			}

		}

		public function cerrar_sesion(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->usuarioModelo->logOut()) {
					redireccionar('usuarios/validar');
				}else{
					die('Algo salio mal');
				}
			}

		}


		public function registro(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$usuarios = $this->usuarioModelo->getUsuarios();

				$datos = [
					'nombre_usuario' => trim($_POST['nombre_usuario']),
					'email' => trim($_POST['email']),
					'usuarios' => $usuarios
				];

						if ($this->usuarioModelo->registroUsuario($datos)) {
							redireccionar('peliculas');
							}else{
								die('Algo salio mal');
							}	



				}else{
					$datos = [
						'nombre_usuario' => '',
						'email' => ''
					];

					$this->vista('usuarios/registro', $datos);

			}

		}


		public function changePass(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$datos = [
					'clave_actual' => trim($_POST['clave_actual']),
					'clave_nueva' => trim($_POST['clave_nueva']),
					'conf_clave_nueva' => trim($_POST['conf_clave_nueva'])
				];

				if ($this->usuarioModelo->cambiarClave($datos)) {
					redireccionar('peliculas');
				}else{
					redireccionar('usuarios/changePass');
				}

			}else{
				$datos = [
					'clave_actual' => '',
					'clave_nueva' => '',
					'conf_clave_nueva' => ''
			];

			$this->vista('usuarios/changePass',$datos);
			}
		}

	}

?>