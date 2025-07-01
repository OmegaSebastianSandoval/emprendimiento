<?php

/**
 * Modelo del modulo Core que se encarga de  enviar todos los correos nesesarios del sistema.
 */
class Core_Model_Sendingemail
{
    /**
     * Intancia de la calse emmail
     * @var class
     */
    protected $email;

    protected $_view;

    public function __construct($view)
    {
        $this->email = new Core_Model_Mail();
        $this->_view = $view;
    }


    public function forgotpassword($user)
    {
        if ($user) {
            $code = [];
            $code['user'] = $user->user_id;
            $code['code'] = $user->code;
            $codeEmail = base64_encode(json_encode($code));
            $this->_view->url = "http://" . $_SERVER['HTTP_HOST'] . "/administracion/index/changepassword?code=" . $codeEmail;
            $this->_view->host = "http://" . $_SERVER['HTTP_HOST'] . "/";
            $this->_view->nombre = $user->user_names . " " . $user->user_lastnames;
            $this->_view->usuario = $user->user_user;
            /*fin parametros de la vista */
            //$this->email->getMail()->setFrom("desarrollo4@omegawebsystems.com","Intranet Coopcafam");
            $this->email->getMail()->addAddress($user->user_email, $user->user_names . " " . $user->user_lastnames);
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/forgotpassword.php');
            $this->email->getMail()->Subject = "Recuperación de Contraseña Gestor de Contenidos";
            $this->email->getMail()->msgHTML($content);
            $this->email->getMail()->AltBody = $content;
            if ($this->email->sed() == true) {
                return true;
            } else {
                return false;
            }
        }
    }



    public function enviarCompra($id)
    {
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);

        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;
        $this->email->getMail()->addAddress("" . $incripcion->pedido_correo, "" . $incripcion->pedido_nombre);
        $this->email->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");
        // $this->email->getMail()->addCC("nogaldelivery@clubelnogal.com");
        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/compra.php');
        $this->email->getMail()->Subject = "Notificación de Compra";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function enviarError($id)
    {
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);
        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;
        //$this->email->getMail()->addAddress($incripcion->pedido_correo,  $incripcion->pedido_nombre);
        $this->email->getMail()->addAddress("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");

        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/error.php');
        $this->email->getMail()->Subject = "Notificación de error Compra";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function envioLimite($producto_id)
    {
        $productosModel = new Page_Model_DbTable_Productos();
        $productos = $productosModel->getById($producto_id);
        $this->_view->productos = $productos;
        $this->email->getMail()->addAddress("soporteomega@clubelnogal.com");
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");
        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/limite.php');
        $this->email->getMail()->Subject = "Alerta stock de producto";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function enviarOTP($email, $nombreCompleto, $code)
    {
        $this->_view->email = $email;
        $this->_view->nombreCompleto = $nombreCompleto;
        $this->_view->code = $code;
        // $this->email->getMail()->addAddress($email, $nombreCompleto);
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com", "Inicio de sesión Fendesa - Emprendimiento");


        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/enviarOTP.php');
        $this->email->getMail()->Subject = 'Ingreso Fendesa - Emprendimiento';
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            return 1;
        } else {
            return 2;
        }
    }
    public function enviarCorreoRegistro($infoTienda, $infoUser)
    {

        $infopageModel = new Page_Model_DbTable_Informacion();
        $infopage = $infopageModel->getById(1);
        $mail_negocio = $infopage->info_pagina_correos_contacto;

        $link = URL_REGISTRO . "/index?id=" . $infoUser->user_id . "&edit=1";
        $this->_view->infoTienda = $infoTienda;
        $this->_view->infoUser = $infoUser;
        $this->_view->link = $link;


        $asunto = "Solicitud de registro emprendimiento fendesa";
        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/alertasolicitudregistro.php');

        //$this->email->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addCC("desarrollo8@omegawebsystems.com");
        //$this->email->getMail()->addAddress($mail_negocio);

        $this->email->getMail()->Subject = $asunto;
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            return 1;
        } else {
            return 2;
        }
    }
    public function enviarInfoRegistro($infoUser)
    {

        $infopageModel = new Page_Model_DbTable_Informacion();
        $infopage = $infopageModel->getById(1);
        $mail_negocio = $infopage->info_pagina_correos_contacto;

        $this->_view->infoUser = $infoUser;




        if ($infoUser->user_state == 1) {
            $asunto = "Alerta de activación de cuenta";
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/alertaactivacion.php');

        } else if ($infoUser->user_state == 2) {
            $asunto = "Alerta de inactivación de cuenta";
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/alertainactivacion.php');

        }

        //$this->email->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addCC("desarrollo8@omegawebsystems.com");
        //$this->email->getMail()->addAddress($mail_negocio);

        $this->email->getMail()->Subject = $asunto;
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            return 1;
        } else {
            return 2;
        }
    }
}
