<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT',realpath(dirname(__FILE__)).DS);
define('FRAMEWORK_PATH', ROOT .'../framework'.DS);
define('APP_PATH', ROOT .'../app'.DS);
define('VIEWS_PATH', APP_PATH .'View'.DS);
define('LAYOUTS_PATH', APP_PATH .'layout'.DS);
define('IMAGE_PATH',APP_PATH."../public_html/images/");
define('FILE_PATH',APP_PATH."../public_html/files/");
define('PUBLIC_PATH',APP_PATH."../public_html/");

date_default_timezone_set('America/Bogota');

require_once FRAMEWORK_PATH.'Config/Config.php';
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            get_include_path(),
            FRAMEWORK_PATH
        )
    )
);

function framework_autoload($classname) {
	$ruta = explode('_',$classname);
    if(substr(end($ruta), -10) == 'Controller') {
        $file = strtolower($ruta[0]).'/Controllers/'.$ruta[1].'.php';
        if (file_exists(APP_PATH.'modules/'.$file)) {
            require_once(APP_PATH.'modules/'.$file);
        }
    } else if (isset($ruta[1]) && $ruta[1] == 'Model'){
        $file = strtolower($ruta[0])."/Models/";
        unset($ruta[0]);
        unset($ruta[1]);
        $file = $file.implode("/",$ruta).'.php';
        if (file_exists(APP_PATH.'modules/'.$file)) {
            require_once(APP_PATH.'modules/'.$file);
        }
    } else {
        $file = implode("/",$ruta).'.php';
        if (file_exists(APP_PATH.'../framework/'.$file)) {
            require_once($file);
        }
    }
}
spl_autoload_register('framework_autoload');

include(APP_PATH.'/../vendor/autoload.php');
$env = "development";
if(strpos($_SERVER['HTTP_HOST'],"nux1.omegasol.tk") !== false){
    $env = "staging";
} else if(strpos($_SERVER['HTTP_HOST'],"nux.clubelnogal.com") !== false){
    $env = "production";
}
define('APPLICATION_ENV', getenv('APPLICATION_ENV')?getenv('APPLICATION_ENV'):$env);

if (APPLICATION_ENV == "development") {
    define('URL_REGISTRO', "http://192.168.150.4:8043/administracion");
    define('URL_LOGIN', "http://192.168.150.4:8043/");

} else {
    define('URL_REGISTRO', "https://delivery.clubelnogal.com/administracion");
    define('URL_LOGIN', "http://192.168.150.4:8043/");

}



error_reporting(E_STRICT);
if($_GET['debug']=="1"){
    error_reporting(E_ALL);
}
ini_set("display_errors", 1);

if (!file_exists(IMAGE_PATH)) {
    mkdir(IMAGE_PATH, 0777, true);
}

if (!file_exists(FILE_PATH)) {
    mkdir(FILE_PATH, 0777, true);
}
/* 
require_once '../vendor/phpoffice/phpExcel/Classes/PHPExcel.php';

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
} */