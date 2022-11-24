<?php

class Bootstrap
{
	public static function run(Request $request)
	{
		$module = $request->getModule();
		$controller = $request->getController() . 'Controller';

		$method = $request->getMethod();
		$args = $request->getArgs();

		if($module):
			$routeModule = ROOT . 'controllers' . DS . $module . 'Controller.php';

			if(is_readable($routeModule)):
				require_once $routeModule;
				$routeController = ROOT . 'modules' . DS . $modulo . DS . 'controllers' . DS . $controller . '.php';
			else:
				header('Location: ' . BASE_URL . 'error/error/');

			endif;
		else:
			$routeController = ROOT . 'controllers' . DS . $controller . '.php';
		endif;

		if(is_readable($routeController)):
			require_once $routeController;

			$controller = new $controller;

			if(is_callable(array($controller, $method))):
				$method = $request->getMethod();
			else:
				header('Location: ' . BASE_URL . 'error/error/');
			endif;

			if(isset($args)):
				call_user_func_array(array($controller, $method), $args);
			else:
				call_user_func(array($controller, $method));
			endif;
		else:
			header('Location: ' . BASE_URL . 'error/error/');
		endif;
	}
}