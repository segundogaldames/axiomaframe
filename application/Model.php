<?php

class Model extends PDO
{
	protected $_db;

	public function __construct(){
		$this->_db = new DBase;
	}
}