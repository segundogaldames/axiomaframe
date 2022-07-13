<?php

class indexController extends Controller
{

	public function __construct(){
		// $this->verificarSession();
		// Session::tiempo();
		parent::__construct();
	}

	public function index()
	{
		$this->getMessages();

		$this->_view->render('index');
	}
}