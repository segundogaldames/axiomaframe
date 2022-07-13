<?php
#llamada al motor de plantillas Smarty
require_once ROOT . 'libs' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty
{
	private $_controller;
	private $_js;
	private $_acl;

	public function __construct(Request $request){
		parent::__construct();
		$this->_controller = $request->getController();
		$this->_js = array();
	}

	public function render($view, $item = false)
	{
		#configuracion de los directorios de la libreria Smarty
		$this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS;
		$this->config_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' .DS;
		$this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
		$this->compile_dir = ROOT . 'tmp' . DS . 'template' . DS;

		#configuracion de los menus predefinidos de los templates o vistas
		$menu = array(
			array(
			),
			array(

				)
			);

		$js = array();

		if(count($this->_js)):
			$js = $this->_js;
		endif;

		#configuracion de rutas de css, js e img para las vistas
		$_params = array(
			'route_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
			'route_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
			'route_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
			'menu' => $menu,
			'item' => $item,
			'js' => $js,
			'root' => BASE_URL,
			'configs' => array(

				)
			);

		$rutaWiev = ROOT . 'views' . DS . $this->_controller . DS . $view . '.tpl';

		if(is_readable($rutaWiev)):
			$this->assign('_content', $rutaWiev);
		else:
			header('Location: ' . BASE_URL . 'error/error/');
		endif;

		$this->assign('_acl', $this->_acl);
		$this->assign('_layoutParams', $_params);
		$this->display('template.tpl');
	}

	public function setJs(array $js)
	{
		if(is_array($js) && count($js)):
			for($i = 0;$i < count($js);$i++ ):
				$this->_js[] = BASE_URL . 'views/' . $this->_controller . '/js/' . $js[$i] . '.js';
			endfor;
		else:
			throw new Exception("Error de js");

		endif;
	}
}