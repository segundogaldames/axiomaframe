<?php
//esta clase no puede ser instanciada
abstract class Controller
{
	protected $_view;

	public function __construct(){
		$this->_view = new View(new Request);
	}
	//obliga a las clases hijas a implementar un metodo index por defecto
	abstract function index();
	abstract function view($id = null);
	abstract function add();
	abstract function new();
	abstract function edit($id = null);
	abstract function update($id = null);

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

	protected function validateSession(){
		if (!Session::get('autenticate')) {
			$this->redirect('login/login');
		}
	}

	protected function validateRol($role){
		if (Session::get('user_role') == $role) {
			return true;
		}

		$this->redirect();
	}

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

	protected function getLibrary($library)
	{
		$routeLibrary = ROOT . 'libs' . DS . $library . '.php';

		if(is_readable($routeLibrary)):
			require_once $routeLibrary;
		else:
			throw new Exception("La librería no está disponible");

		endif;
	}

	//filtrar variable que viene via post en el formulario
	protected function getText($text)
	{
		if(isset($_POST[$text]) && !empty($_POST[$text])):
			$_POST[$text] = htmlspecialchars($_POST[$text], ENT_QUOTES); //transforma comillas simpes y dobles
			return trim($_POST[$text]);
		endif;

		return '';
	}

	//metodo que valida numeros enviados via post en el formulario
	protected function getInt($int)
	{
		if(isset($_POST[$int]) && !empty($_POST[$int])):
			$_POST[$int] = filter_input(INPUT_POST, $int, FILTER_VALIDATE_INT); //valida numeros tipo integer
			return $_POST[$int];
		endif;

		return 0;
	}

	protected function getFloat($float)
	{

		if(isset($_POST[$float]) && !empty($_POST[$float])):
			$_POST[$float] = filter_input(INPUT_POST, $float, FILTER_VALIDATE_FLOAT); //valida numeros tipo integer
			return $_POST[$float];
		endif;

		return 0;
	}

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

	//metodo que filtra un id que viene por get en un formulario o enlace
	protected function filterInt($int)
	{
		$int = (int) $int;

		if(is_int($int)):
			return $int;
		else:
			return 0;
		endif;
	}

	//metodo que devuelve los parametros sin filtrar
	protected function getPostParam($data)
	{
		if(isset($_POST[$data])):
			return $_POST[$data];
		endif;
	}

	//metodo que filtra las inyecciones sql
	protected function getSql($data)
	{
		if(isset($_POST[$data]) && !empty($_POST[$data])):
			$_POST[$data] = strip_tags($_POST[$data]);


			return trim($_POST[$data]);
		endif;
	}

	//reemplaza los caracteres diferentes a los patrones de preg_replace
	protected function getAlphaNum($data)
	{
		if(isset($_POST[$data]) && !empty($_POST[$data])):
			$_POST[$data] = (string) preg_replace('/[^A-Z0-9_][*\s][?\-]/i', '', $_POST[$data]);
			return trim($_POST[$data]);
		endif;
	}

	public function validateEmail($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
			return false;
		endif;

		return  true;
	}

	protected function encrypt($value)
	{
		$data = openssl_encrypt($value, METHODENCRIPT, KEY);
		return $data;
	}

	protected function decrypt($value)
	{
		$data = openssl_decrypt($value, METHODENCRIPT, KEY);
		return $data;
	}

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

	protected function validateForm($route, $data)
	{
		//print_r($data);exit;
		if ($this->decrypt($this->getAlphaNum('send')) != $this->getForm()) {
			$this->redirect('error/noPermit');
		}

		Session::set('data',$_POST);

		if (is_array($data)) {
			foreach ($data as $data=>$value) {
				if ($value == '') {
					$error = "El campo <strong>$data</strong> es obligatorio";
				}

				if (isset($error)) {
					Session::set('msg_error', $error);
					$this->redirect($route);
				}
			}
		}
	}

	protected function validatePUT()
	{
		if ($this->getText('_method') != 'PUT') {
			$this->redirect('error/noPermit');
		}
	}


	public function validateUrl($url)
	{
		if(!filter_var($url, FILTER_VALIDATE_URL)):
			return false;
		endif;

		return true;
	}

	public function inArray($array)
	{
		if (is_array($array)) {
			foreach ($_POST[$array] as $data) {
				$array = implode(',', $data);
			}
			return $array;
		}
		return $_POST[$array];
	}

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
}