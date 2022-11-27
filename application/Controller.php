<?php

class Controller
{
	protected $_view;

	public function __construct(){
		$this->_view = new View(new Request);
	}

	#metodo para encriptar usando openssl
	protected function encrypt($value)
	{
		$data = openssl_encrypt($value, METHODENCRIPT, KEY);
		return $data;
	}

	#metodo para desencriptar usando openssl
	protected function decrypt($value)
	{
		$data = openssl_decrypt($value, METHODENCRIPT, KEY);
		return $data;
	}

	#metodo que crea un hash para validar formulario
	protected function getForm()
	{
		$now = getdate();
		$now = $now['year']. $now['month'] . $now['mday'] . $now['hours'];
		if (Session::get('autenticate')) {
			$send = Session::get('user_name') . $now;
		}else {
			$send = CTRL . $now;
		}

		return $send;
	}

	#metodo que recupera una libreria desde la carpeta libs
	protected function getLibrary($library)
	{
		$routeLibrary = ROOT . 'libs' . DS . $library . '.php';

		if(is_readable($routeLibrary)):
			require_once $routeLibrary;
		else:
			throw new Exception("La librería no está disponible");

		endif;
	}

	#metodo que permite enviar mensajes desde los controladores hacia las vistas
	#mensajes de exito
	#mensajes de error
	protected  function getMessages(){
		if (Session::get('msg_success')) {
			$msg_success = Session::get('msg_success');
			$this->_view->assign('_mensaje', $msg_success);
			Session::destroy('msg_success');
		}

		if (Session::get('msg_error')) {
			$msg_error = Session::get('msg_error');
			$this->_view->assign('_error', $msg_error);
			Session::destroy('msg_error');
		}
	}

	#metodo alternativo para recuperar modelos
	#se usa cuando se conecta la base de datos con la clase DBase
	#propositos especiales o complejos
	protected function loadModel($modelo)
	{
		$modelo = $modelo . 'Model';
		$rutaModelo = ROOT . 'models' . DS . $modelo . '.php';

		if(is_readable($rutaModelo)):
			require_once $rutaModelo;
			$modelo = new $modelo;
			return $modelo;
		else:
			throw new Exception("Error de modelo");

		endif;
	}

	#metodo que redirecciona a una ruta especifica
	#si no se menciona la ruta, redirecciona a la raiz del proyecto
	protected function redirect($route = false)
	{
		if($route):
			header('Location:' . BASE_URL . $route);
			exit;
		else:
			header('Location:' . BASE_URL);
			exit;
		endif;
	}

	#metodo que valida el uso del metodo delete en el formulario
	#usado para eliminar un registro en la base de datos
	protected function validateDelete()
	{
		if (Filter::getText('_method') != 'DELETE') {
			$this->redirect('error/denied');
		}
	}

	#metodo que valida un email
	protected function validateEmail($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
			return false;
		endif;

		return  true;
	}

	#metodo que valida campos enviados desde un formulario via POST
	#recibe la ruta de redireccionamiento
	protected function validateForm($route, $data)
	{
		//print_r($data);exit;
		if ($this->decrypt(Filter::getAlphaNum('send')) != $this->getForm()) {
			$this->redirect('error/denied');
		}

		Session::set('data',$_POST);

		if (is_array($data)) {
			foreach ($data as $data=>$value) {
				if ($value == '' || $value == 0) {
					$error = "El campo <strong>$data</strong> es obligatorio";
				}

				if (isset($error)) {
					Session::set('msg_error', $error);
					$this->redirect($route);
				}
			}
		}
	}

	#metodo que valida el metodo PUT en el formulario
	#usado para modificar un registro en la base de datos
	protected function validatePUT()
	{
		if (Filter::getText('_method') != 'PUT') {
			$this->redirect('error/denied');
		}
	}

	#metodo que permite dar accesos a un rol o a un grupo de ellos
	#usado en controladores
	protected function validateRol($roles){

		if (is_array($roles)) {
			foreach ($roles as $role) {
				if (Session::get('user_role') == $role) {
					return true;
				}
			}
		}

		$this->redirect();
	}

	#metodo que verifica la autenticacion de un usuario
	protected function validateSession(){
		if (!Session::get('autenticate')) {
			$this->redirect('login/login');
		}

		Session::resetId();
	}

	#metodo que comprueba la veracidad de un RUT
	protected function validateRut($rut)
	{
		$rut = preg_replace('/[^k0-9]/i', '', $rut);
		$dv  = substr($rut, -1);
		$num = substr($rut, 0, strlen($rut)-1);
		$i = 2;
		$sum = 0;

		foreach(array_reverse(str_split($num)) as $v)
		{
			if($i==8)
				$i = 2;

			$sum += $v * $i;
			++$i;
		}

		$dvr = 11 - ($sum % 11);

		if($dvr == 11)
			$dvr = 0;
		if($dvr == 10)
			$dvr = 'K';

		if($dvr == strtoupper($dv))
			return true;
		else
			return false;
	}

	#metodo que valida una url en un formulario via POST
	public function validateUrl($url)
	{
		if(!filter_var($url, FILTER_VALIDATE_URL)):
			return false;
		endif;

		return true;
	}
}