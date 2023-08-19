<?php

class errorController extends Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function error()
	{
		$message = 'Sitio no encontrado';

		$this->_view->load('error/error', compact('message'));
	}

	public function denied()
	{
		$message = 'Acceso no permitido';
		
		$this->_view->load('error/denied', compact('message'));
	}
}