<?php

class View
{
    protected $_data;

    function __construct($data = array())
    {
        $this->_data = $data;
    }

    function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    function __get($name)
    {
        return $this->_data[$name];
    }

    public function getObjectVariable($object, $var)
    {
        if (isset($object) AND isset($object->$var)) {
            return $object->$var;
        } else {
            return "";
        }
    }
    public function getRoutPHP($url,$parameter = '')
    {
        $rout=APP_PATH.$url;
        if(isset($rout) && file_exists($rout)){
            ob_start();
            include($rout);
            $content = ob_get_clean();
            return $content;
        }
        return "" ;
    }
    public function render($filename)
    {
        if(is_readable($filename)){
            $fileContents = file_get_contents($filename);
            return eval("?>".$fileContents);
        } else {
            return "";
        }

    }

    public function id_youtube($url) {
        $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
        $array = preg_match($patron, $url, $parte);
        if (false !== $array) {
            return $parte[1];
        }
        return false;
    }

    public function urllimpia($url) {
        // Tranformamos todo a minusculas
        $url = strtolower($url);
        $url= html_entity_decode($url);
        //Rememplazamos caracteres especiales latinos
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n');
        $url = str_replace ($find, $repl, $url);
        // Añaadimos los guiones
        $find = array(' ', '&', '\r\n', '\n', '+'); 
        $url = str_replace ($find, '-', $url);
        // Eliminamos y Reemplazamos demás caracteres especiales
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $repl = array('', '-', '');
        $url = preg_replace ($find, $repl, $url);
        return $url;
    }
}