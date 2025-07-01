<?php

/**
*
*/

class Page_loginController extends Page_mainController
{

	public function indexAction()
	{
        $this->getLayout()->setData("ocultarcarrito",1);
	}



    public function loginAction()
    {

        $this->setLayout('blanco');

        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");
        $password = str_pad($password, 8, "0", STR_PAD_LEFT);

        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ","");
        if(count($socio)>0){
            Session::getInstance()->set("kt_cedula",$user);
            //header("Location:/page/index");
            header("Location:/page/index");
        }else{
            $error = 1;
            $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' ")[0];
            if($socio->socio_estado=="0"){
                $error=2;
            }
            header("Location:/page/login/?cedula=".$user."&error=".$error);
        }

    }


    public function login2Action()
    {


        $user = $this->_getSanitizedParam("usuario");
        $password = $this->_getSanitizedParam("clave");
        $hash= $this->_getSanitizedParam("hash");
        $userModel = new Core_Model_DbTable_User();
        $usuario_existe=$userModel->getList("user_user='$user'");
        if ($userModel->autenticateUser($user,$password) == true or (count($usuario_existe)>0 and $hash==md5($user."OMEGA") )) {

            $resUser = $userModel->searchUserByUser($user);
            if($resUser->user_state_password==0){
            if($resUser->user_state==1){
                if($resUser->user_level=="2"||$resUser->user_level=="3"||$resUser->user_level=="4"||$resUser->user_level=="5" ||$resUser->user_level=="1"){
            Session::getInstance()->set("kt_login_id",$resUser->user_id);
            Session::getInstance()->set("kt_login_level",$resUser->user_level);
            Session::getInstance()->set("kt_login_user",$resUser->user_user);
            Session::getInstance()->set("kt_login_state",$resUser->user_state);
            Session::getInstance()->set("kt_login_name",$resUser->user_names);
         
            header("Location:/page/index");
        }else{
            header("Location:/page/login/?usuario=".$user."&error=3");
        }
           
            }else{
                header("Location:/page/login/?usuario=".$user."&error=2");
            }
        }else{
            header("Location:/page/login/?usuario=".$user."&recuperar=1");
        }
        }else{
            //echo "error2";
            header("Location:/page/login/?usuario=".$user."&error=1");
        }

    }

    public function actualizarAction()
    {

        $header2 = "";
        $this->getLayout()->setData("header",$header2);
        $footer2 = "";
        $this->getLayout()->setData("footer",$footer2);


        $userModel = new Core_Model_DbTable_User();
        $this->_view->usuario = $userModel->getById($_SESSION['kt_login_id']);

    }


    public function guardarAction()
    {

        $header2 = "";
        $this->getLayout()->setData("header",$header2);
        $footer2 = "";
        $this->getLayout()->setData("footer",$footer2);


        $userModel = new Core_Model_DbTable_User();
        $user_id = $_SESSION['kt_login_id'];
        $usuario = $userModel->getById($_SESSION['kt_login_id']);

        $nombre = $this->_getSanitizedParam("nombre");
        $celular = $this->_getSanitizedParam("celular");
        $correo = $this->_getSanitizedParam("correo");
        $clave = $this->_getSanitizedParam("clave");

        $usuarios = $userModel->getList(" user_consecutivo IS NOT NULL "," user_consecutivo*1 DESC ");
        $consecutivo = $usuarios[0]->user_consecutivo;
        $consecutivo = $consecutivo*1;
        $consecutivo++;

        $userModel->editField($user_id,"user_names",$nombre);
        $userModel->editField($user_id,"user_celular",$celular);
        $userModel->editField($user_id,"user_email",$correo);
        if($clave != ""){
            $clave_codificada=password_hash($clave, PASSWORD_DEFAULT);
            $userModel->editField($user_id,"user_password",$clave_codificada);
        }
        if($usuario->user_consecutivo==""){
            $hoy = date("Y-m-d H:i:s");
            $userModel->editField($user_id,"user_fecha_actualizacion",$hoy);
            $userModel->editField($user_id,"user_consecutivo",$consecutivo);
        }

        $this->_view->usuario = $userModel->getById($_SESSION['kt_login_id']);


    }


    public function recordarAction()
    {
        $contentModel = new Page_Model_DbTable_Content();
        $header2 = "";
        $this->getLayout()->setData("header",$header2);
        $footer2 = "";
        $this->getLayout()->setData("footer",$footer2);
    }

    public function recordar2Action()
    {
        $contentModel = new Page_Model_DbTable_Content();
        $header2 = "";
        $this->getLayout()->setData("header",$header2);
        $footer2 = "";
        $this->getLayout()->setData("footer",$footer2);

        $correo = $this->_getSanitizedParam("correo");
        $userModel = new Core_Model_DbTable_User();
        $existe = $userModel->getList(" user_email = '$correo' ","");

        if(count($existe)>0){

            $usuario = $existe[0]->user_user;
            $clave = substr($usuario,-4);

            $emailModel = new Core_Model_Mail();
            $asunto = "Recuperar contraseña PEPSICO";
            $content = '
            <p>Estimado asociado(a), estos son sus datos de acceso:</p><br>
            <b>URL: </b><a href="http://pepsico.omegasol.tk/">http://pepsico.omegasol.tk/</a><br>
            <b>Usuario:</b> '.$usuario.'<br>
            <b>Contraseña:</b> '.$clave.'<br>';

            $emailModel->getMail()->setFrom("notificaciones@pepsico.omegasol.tk", "Notificaciones PEPSICO");
            $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
            //$emailModel->getMail()->addAddress("".$correo);

            $emailModel->getMail()->Subject = $asunto;
            $emailModel->getMail()->msgHTML($content);
            $emailModel->getMail()->AltBody = $content;
            $emailModel->sed();

            $this->_view->mensaje="Su contraseña fue enviada al correo ".$correo;

        }else{
            $this->_view->mensaje="El correo ".$correo." no se encuentra registrado";
        }

    }


    public function logoutAction()
	{
		//LOG
		$data['log_tipo'] = "LOGOUT";
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);

		Session::getInstance()->set("kt_login_id","");
		Session::getInstance()->set("kt_login_level","");
		Session::getInstance()->set("kt_login_user","");
		Session::getInstance()->set("kt_login_name","");
        Session::getInstance()->set("kt_cedula","");
		header('Location: /page/login');
	}
    public function olvidoAction()
	{
        $userModel = new Administracion_Model_DbTable_Usuario();
        $user = $this->_getSanitizedParam("usuario");
        $password=rand(1000,9999);
        $usuario=$userModel->getList("user_user='$user'","")[0];
        $correo=$usuario->user_email;
        $password2=password_hash($password, PASSWORD_DEFAULT);
        $userModel->editFielduser($user,"user_password",$password2);
        $userModel->editFielduser($user,"user_state_password",1);
        $this->enviarcorreo($password,$correo);
        header('Location: /page/login');
	
    }
    public function cambiarpasswordAction(){
        $userModel = new Administracion_Model_DbTable_Usuario();
        $user = $this->_getSanitizedParam("usuario");
        $user2 =md5($user."OMEGA");
        $password=$this->_getSanitizedParam("contrasena");
        $password2=password_hash($password, PASSWORD_DEFAULT);
        $userModel->editFielduser($user,"user_password",$password2);
        $userModel->editFielduser($user,"user_state_password",0);
        header("Location:/page/login/login2?usuario=".$user."&hash=".$user2."");
    }
   
    public function enviarcorreo($contrasena , $correo)
	{
		$content = '<p>Buenos días,</p>
		 Ha solicitado la restauración de contraseña en nux virtual, su nueva contraseña es '.$contrasena.'
		'
		;

        $emailModel = new Core_Model_Mail();
        $asunto = "Solicitud de recuperación de contraseña nux virtual";

        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        // $emailModel->getMail()->addCC("");
        $emailModel->getMail()->addAddress($correo);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->getMail()->SMTPDebug = 0;
        $emailModel->sed();
	}
}