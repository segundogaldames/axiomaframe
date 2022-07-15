<?php

class Filter
{
	#metodo que filtra un numero via GET
	public static function filterInt($int)
	{
		$int = (int) $int;

		if(is_int($int)):
			return $int;
		else:
			return 0;
		endif;
	}

	#metodo que filtra una cadena alfanumerica via POST
    public static function getAlphaNum($data)
	{
		if(isset($_POST[$data]) && !empty($_POST[$data])):
			$_POST[$data] = (string) preg_replace('/[^A-Z0-9_][*\s][?\-]/i', '', $_POST[$data]);
			return trim($_POST[$data]);
		endif;
	}

	#metodo que filtra un numero flotante via POST
    public static function getFloat($float)
	{
		if(isset($_POST[$float]) && !empty($_POST[$float])):
			$_POST[$float] = filter_input(INPUT_POST, $float, FILTER_VALIDATE_FLOAT); //valida numeros tipo integer
			return $_POST[$float];
		endif;

		return 0;
	}

	#metodo que filtra un numero via POST
    public static function getInt($int)
	{
		if(isset($_POST[$int]) && !empty($_POST[$int])):
			$_POST[$int] = filter_input(INPUT_POST, $int, FILTER_VALIDATE_INT); //valida numeros tipo integer
			return $_POST[$int];
		endif;

		return 0;
	}

	#metodo que filtra un array via POST
    public static function inArray($array)
	{
		if (is_array($array)) {
			foreach ($_POST[$array] as $data) {
				$array = implode(',', $data);
			}
			return $array;
		}
		return $_POST[$array];
	}

	#metodo que filtra una cadena via POST
    public static function getPostParam($data)
	{
		if(isset($_POST[$data])):
			return trim($_POST[$data]);
		endif;
	}

	#metodo que filtra una cadena desactivando tags via POST
    public static function getSql($data)
	{
		if(isset($_POST[$data]) && !empty($_POST[$data])):
			$_POST[$data] = strip_tags($_POST[$data]);


			return trim($_POST[$data]);
		endif;
	}

	#metodo que filtra un texto via POST
    public static function getText($text)
    {
        if(isset($_POST[$text]) && !empty($_POST[$text])):
			$_POST[$text] = htmlspecialchars($_POST[$text], ENT_QUOTES); //transforma comillas simpes y dobles
			return trim($_POST[$text]);
		endif;

		return '';
    }
}
