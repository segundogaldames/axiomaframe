<?php

class errorController extends Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function error()
	{
		$this->_view->assign('titulo', 'Página No Encontrada');
		$this->_view->assign('mensaje', 'Sitio no encontrado');
		$this->_view->render('error');
	}

	public function denied()
	{
		$this->_view->assign('titulo', 'Inaccesible');
		$this->_view->assign('mensaje', 'Acceso no permitido');
		$this->_view->render('denied');
	}
}