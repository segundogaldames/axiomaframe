<?php
use \Twig\Enviroment;
use Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class View
{
	private $_controller;
	private $_js;
	private $_acl;

	public function __construct(Request $request){
		$this->_controller = $request->getController();
		$this->_js = array();
	}

	public function load($view, $params = [])
	{
		$route_template = ROOT . 'views' . DS;
		$twig = new Environment(new FilesystemLoader('views/'));
		$twig->addGlobal('BASE', BASE_URL);

		//print_r($twig);exit;

		echo $twig->render($view . '.twig', $params);
		

		// $this->assign('_acl', $this->_acl);
		// $this->assign('_layoutParams', $_params);
		// $this->display('template.tpl');
	}
}