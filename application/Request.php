<?php

class Request
{
	private $_module;
	private $_controller;
	private $_method;
	private $_arguments;
	private $_modules;

	public function __construct(){
		//si existe la url, sanitiza la url
		if(isset($_GET['url'])){
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url); //divide la url separandola con "/"
			$url = array_filter($url); //elimina los elementos no validos de la url

			//1. obtener url modulo/controlador/metodo/argumentos
			//2. obtener url controlador/metodo/argumentos
			//el modulo de la aplicacion va dentro del array
			//$this->_modules = array('usuarios');
			$this->_module = strtolower(@array_shift($url));

			if(!$this->_module):
				$this->_module = false;
			else:
				if(is_countable($this->_modules)):
					if(!in_array($this->_module, $this->_modules)):
						$this->_controller = $this->_module;
						$this->_module = false;
					else:
						$this->_controller = strtolower(@array_shift($url));

						if(!$this->_controller):
							$this->_controller = 'index';
						endif;
					endif;
				else:
					$this->_controller = $this->_module;
					$this->_module = false;
				endif;
			endif;

			$this->_method = @strtolower(@array_shift($url)); //extrae el segundo elemento y lo asigna a metodo
			$this->_arguments = $url; //lo que queda lo asigna a argumentos
		}


		if(!$this->_controller){
			$this->_controller = DEFAULT_CONTROLLER;
		}

		if(!$this->_method){
			$this->_method = 'index';
		}

		if(!isset($this->_arguments)){
			$this->_arguments = array();
		}
	}

	public function getModule()
	{
		return $this->_module;
	}

	public function getController()
	{
		return $this->_controller;
	}

	public function getMethod()
	{
		return $this->_method;
	}

	public function getArgs()
	{
		return $this->_arguments;
	}
}