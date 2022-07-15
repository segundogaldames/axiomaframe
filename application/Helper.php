<?php

class Helper
{
    #metodo que reemplaza los acentos de las vocales en español
    public static function clearString($string)
    {
        //Reemplazamos la A y a
        $string = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $string
        );

        //Reemplazamos la E y e
        $string = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $string );

        //Reemplazamos la I y i
        $string = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $string );

        //Reemplazamos la O y o
        $string = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $string );

        //Reemplazamos la U y u
        $string = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $string );

        //Reemplazamos la N, n, C y c
        $string = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç',',','.',';',':'),
        array('N', 'n', 'C', 'c','','','',''),
        $string
        );
        return $string;
    }

    #metodo que encripta la contraseña o password
    public static function encryptPassword($password)
    {
        $password = Hash::getHash('sha512', $password, HASH_KEY);

        return $password;
    }

    #metodo que construye una url amigable a partir del campo de un objeto
    public static function friendlyRoute($value)
    {
        $route = strtolower(self::clearString($value));
        $route = str_replace(' ','-', $route);

        return $route;
    }

    #metodo que obtiene las iniciales del nombre de un usuario
    public static function getInitials($name)
    {
        if ($name) {
            $initials = '';
            $explode = explode(' ', $name);
            foreach ($explode as $ex) {
                $initials .= $ex[0];
            }

            return $initials;
        }
    }

    #metodo que permite el acceso a un elemento a partir de un rol
    public static function getRolAdmin($role)
    {
        if (Session::get('user_rol') == $role) {
            return true;
        }

        return false;
    }

    #metodo que crea una password de 10 caracteres de largo
    public static function passGenerator($length = 10)
    {
        $pass = "";
        $lengthPass=$length;
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890$/.*";
        $lengthString=strlen($string);

        for($i=1; $i<=$lengthPass; $i++) {
            $pos=rand(0,$lengthString-1);
            $pass .=substr($string,$pos,1);
        }
        return $pass;
    }

    #metodo que limpia una cadena de diversos elementos
    public static function strClean($string)
    {
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $string);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>
            ","
            ",$string);
            $string = str_ireplace("
        </script>","",$string);
        $string = str_ireplace("<script src>
        ","
        ",$string);
        $string = str_ireplace("<script type=>", "", $string);
        $string = str_ireplace("SELECT * FROM", "", $string);
        $string = str_ireplace("DELETE FROM", "", $string);
        $string = str_ireplace("INSERT INTO", "", $string);
        $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
        $string = str_ireplace("DROP TABLE", "", $string);
        $string = str_ireplace("OR '1'='1", "", $string);
        $string = str_ireplace('OR "1"="1"', "", $string);
        $string = str_ireplace('OR ´1´=´1´', "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("LIKE '", "", $string);
        $string = str_ireplace('LIKE "', "", $string);
        $string = str_ireplace("LIKE ´", "", $string);
        $string = str_ireplace("OR 'a'='a", "", $string);
        $string = str_ireplace('OR "a"="a', "", $string);
        $string = str_ireplace("OR ´a´=´a", "", $string);
        $string = str_ireplace("OR ´a´=´a", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);

        return $string;
    }

    #metodo que crea un token
    public static function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }
}
