<?php

class Session
{
	public static function init()
	{
		session_start();
	}

	#metodo que destruye una o varias variables de session
	public static function destroy($key = false)
	{
		if($key):
			if(is_array($key)):
				for($i = 0;$i < count($key);$i++):
					if(isset($_SESSION[$key[$i]])):
						unset($_SESSION[$key[$i]]);
					endif;
				endfor;
			else:
				if(isset($_SESSION[$key])):
					unset($_SESSION[$key]);
				endif;
			endif;
		else:
			session_destroy();
		endif;
	}

	#metodo que crea variables de session
	public static function set($key, $value)
	{
		if(!empty($key)):
			$_SESSION[$key] = $value;
		endif;
	}

	#metodo que lee una variable de session
	public static function get($key)
	{
		if(isset($_SESSION[$key])):
			return $_SESSION[$key];
		endif;
	}

	public static function resetId()
	{
		session_regenerate_id();
	}

	#metodo que define un tiempo de session
	public static function time()
	{
		if(!Session::get('time') || !defined('SESSION_TIME')):
			throw new Exception("Tiempo de session no definido");

		endif;

		if(SESSION_TIME == 0): //se asume que el tiempo de session es indefinido
			return;
		endif;

		if(time() - Session::get('time') > (SESSION_TIME * 60)):
			Session::destroy();
			header('Location: ' . BASE_URL . 'login/logout');
		else:
			Session::set('time', time());
		endif;
	}
}