<?php

	/*
	Mapear(Obtener) la URL ingresada en el navegador,
	1- Controlador
	2- Metodo
	3- Parametro
	*/

	class Core{
		protected $controladorActual = 'peliculas';
		protected $metodoActual = 'index';
		protected $parametros = [];

		//Constructor
		public function __construct(){
			//print_r($this->getUrl());
			$url = $this->getUrl();

			//Buscar en controladores si el controlador existe
			if (file_exists('../app/controladores/' . ucwords($url[0]).'.php')) {
				//Si existe se configura como controlador por defecto
				$this->controladorActual = ucwords($url[0]);


				//Unset indice 0 del array url
				unset($url[0]);
			}

			//Requerimos el controlador
			require_once '../app/controladores/'. $this->controladorActual . '.php';
			$this->controladorActual = new $this->controladorActual;

			//Obtener la url[2] osea el metodo
			//Verificamos si el metodo existe
			if (isset($url[1])) {
				if (method_exists($this->controladorActual, $url[1])) {
				//Revisamos el metodo
				$this->metodoActual = $url[1];

				//unset indice
				unset($url[1]);
				}				
			}
			/*Prueba			
			/echo $this->metodoActual;*/

			//Obtenemos los posibles parametros

			//Se utiliza un operador ternario 
			$this->parametros = $url ? array_values($url) : [];

			//Llamar callback con parametros array
			call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

		}

		public function getUrl(){
			//echo $_GET['url'];

			if (isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url,FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
		}
	}

?>