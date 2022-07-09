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

	public function view($id = null)
	{

	}

	public function edit($id = null)
	{

	}

	public function update($id = null)
	{

	}

	public function add()
	{

	}

	public function new()
	{

	}
}