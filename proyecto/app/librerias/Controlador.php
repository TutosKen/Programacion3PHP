<?php
	
	//Clase controlador principal
	//Se encarga de cargar los modelos y las vistas

	class Controlador{

		//Cargar modelo
		public function modelo($modelo){
			//carga
			require_once '../app/modelo/' . $modelo . '.php';
			//Instanciar el modelo
			return new $modelo();
		}

		//carga vista
		public function vista($vista,$datos = []){
			//Verificar si el archivo vista existe
			if (file_exists('../app/vista/' . $vista . '.php')) {
			require_once '../app/vista/' . $vista . '.php';
			}
			else{
				//Si no existe
				die('La vista no existe');
			}
		}


	}

?>