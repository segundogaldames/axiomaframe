<?php

class errorController extends Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function error()
	{
		$this->_view->assign('title', 'Página No Encontrada');
		$this->_view->assign('message', 'Sitio no encontrado');
		$this->_view->render('error');
	}

	public function denied()
	{
		$this->_view->assign('title', 'Inaccesible');
		$this->_view->assign('message', 'Acceso no permitido');
		$this->_view->render('denied');
	}
}