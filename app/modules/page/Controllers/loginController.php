<?php

/**
 *
 */

class Page_loginController extends Page_mainController
{

    public function indexAction()
    {
        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->_view->error = Session::getInstance()->get("error_login");
        $this->_view->error_emp = Session::getInstance()->get("error_login_emp");

        Session::getInstance()->set("error_login", "");
        Session::getInstance()->set("error_login_emp", "");


    }
    public function loginAction()
    {

        // error_reporting(E_ALL);
        $this->getLayout()->setData("ocultarcarrito", 1);

        $this->setLayout("blanco");
        $user = $this->_getSanitizedParam("user");
        if (!$user) {
            $response = array(
                "error" => 1,
                "message" => "Debe ingresar su documento de identificación"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }

        $asociado = $this->getAsociadoInfo($user);

        if (!$asociado) {
            $response = array(
                "error" => 1,
                "message" => "No se encontró un asociado con el documento ingresado"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }
        if (!$asociado['user_email']) {
            $response = array(
                "error" => 1,
                "message" => "El asociado no tiene un correo electrónico registrado"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }
        $email = $asociado['user_email'];
        $nombreCompleto = $asociado['user_names'] . " " . $asociado['user_lastnames'];
        $otp = $this->generateOTP();
        $otpModel = new Administracion_Model_DbTable_Otpcodes();
        $otpData = array(
            'user' => $email,
            'code' => $otp,
            'nit' => $user,
            'date' => date('Y-m-d H:i:s')
        );
        $otpId = $otpModel->insert($otpData);

        if (!$otpId) {
            $response = array(
                "error" => 1,
                "message" => "Error al generar el código de verificación"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }

        $mailModel = new Core_Model_Sendingemail($this->_view);
        $boolMail = $mailModel->enviarOTP($email, $nombreCompleto, $otp);
        if ($boolMail == 1) {
            $response = array(
                "error" => 0,
                "message" => "Se ha enviado un código de verificación a su correo electrónico",
                "email" => base64_encode($email),
                "name" => $nombreCompleto,
            );
            header('Location: /page/login/otp?e=' . base64_encode($email));

        } else {
            $response = array(
                "error" => 1,
                "message" => "Error al enviar el código de verificación. Por favor, inténtelo de nuevo más tarde."
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
        }




    }

    public function otpAction()
    {
        $email = base64_decode($this->_getSanitizedParam('e'));
        if ($this->_getSanitizedParam('emp') == 1) {
            $this->_view->emp = 1;
        }

        $this->_view->emailHidden = $this->_getSanitizedParam('e');
        //Ocultar caracteres de correo
        $email = explode('@', $email);
        $email[0] = substr($email[0], 0, 5) . '***';
        $email = implode('@', $email);
        $this->_view->email = $email;
    }
    public function login2Action()
    {
        $this->setLayout('blanco');
        $response = [];
        $otp = '';
        for ($i = 1; $i <= 6; $i++) {
            $otp .= $this->_getSanitizedParam('otp' . $i);
        }
        $email = base64_decode($this->_getSanitizedParam('email'));
        $dateFifteenMinutesAgo = date('Y-m-d H:i:s', strtotime('-15 minutes'));
        $otpModel = new Administracion_Model_DbTable_Otpcodes();
        // $otpData = $otpModel->getList("code = '$otp' AND date >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)", "");
        $otpData = $otpModel->getList("code = '$otp' AND date >= '$dateFifteenMinutesAgo'", "");

        if (!$otpData) {
            $response = array(
                "error" => 1,
                "message" => "Código de verificación incorrecto o expirado. Por favor, inténtelo de nuevo."
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login/');
            exit;
        }


        $email = $otpData[0]->user;
        $cedula = $otpData[0]->nit;
        $response = $this->getAsociado($cedula);

        if (!$response) {
            $response = array(
                "error" => 1,
                "message" => "No se encontró un asociado con el documento ingresado"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login/');
            exit;
        }

        $data = [];
        $data['kt_login_id'] = $response['user_id'];
        $data['kt_login_level'] = $response['user_level'];
        $data['kt_login_user'] = $response['user_user'];
        $data['kt_login_name'] = $response['user_names'];
        $data['kt_last_names'] = $response['user_lastnames'];
        $data['user_phone'] = $response['user_phone'];
        $data['user_email'] = $response['user_email'];
        $_SESSION["asociado"] = $data;
        Session::getInstance()->set("kt_login_id", $response['user_id']);
        Session::getInstance()->set("kt_login_level", $response['user_level']);
        Session::getInstance()->set("kt_login_user", $response['user_user']);
        Session::getInstance()->set("kt_login_name", $response['user_names']);
        Session::getInstance()->set("kt_last_names", $response['user_lastnames']);
        Session::getInstance()->set("user_phone", $response['user_phone']);
        Session::getInstance()->set("user_email", $response['user_email']);
        Session::getInstance()->set("asociado", $data);

        header('Location: /');
        exit;

    }

    public function loginempAction()
    {

        // error_reporting(E_ALL);
        $this->getLayout()->setData("ocultarcarrito", 1);

        $this->setLayout("blanco");
        $user = $this->_getSanitizedParam("user");
        if (!$user) {
            $response = array(
                "error" => 1,
                "message" => "Debe ingresar su documento de identificación"
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
            exit;
        }
        $userModel = new core_Model_DbTable_User();

        $resUser = $userModel->searchUserByUser($user);
        if (!$resUser) {
            $response = array(
                "error" => 1,
                "message" => "No se encontró un emprendimiento con el documento ingresado"
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
            exit;
        }
        if ($resUser->user_state != 1) {
            $response = array(
                "error" => 1,
                "message" => "El emprendimiento se encuentra inactivo."
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
            exit;
        }

        if (!$resUser->user_email) {
            $response = array(
                "error" => 1,
                "message" => "El emprendimiento no tiene un correo electrónico registrado."
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
            exit;
        }
        $email = $resUser->user_email;
        $nombreCompleto = $resUser->user_names;
        $otp = $this->generateOTP();
        $otpModel = new Administracion_Model_DbTable_Otpcodes();
        $otpData = array(
            'user' => $email,
            'code' => $otp,
            'nit' => $user,
            'date' => date('Y-m-d H:i:s')
        );
        $otpId = $otpModel->insert($otpData);

        if (!$otpId) {
            $response = array(
                "error" => 1,
                "message" => "Error al generar el código de verificación"
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
            exit;
        }

        $mailModel = new Core_Model_Sendingemail($this->_view);
        $boolMail = $mailModel->enviarOTP($email, $nombreCompleto, $otp);
        if ($boolMail == 1) {
            $response = array(
                "error" => 0,
                "message" => "Se ha enviado un código de verificación a su correo electrónico",
                "email" => base64_encode($email),
                "name" => $nombreCompleto,
            );
            header('Location: /page/login/otp?e=' . base64_encode($email) . '&emp=1');

        } else {
            $response = array(
                "error" => 1,
                "message" => "Error al enviar el código de verificación. Por favor, inténtelo de nuevo más tarde."
            );
            Session::getInstance()->set("error_login_emp", $response);
            header('Location: /page/login?emp=1');
        }

    }

    public function loginemp2Action()
    {
        $this->setLayout('blanco');
        $response = [];
        $otp = '';
        for ($i = 1; $i <= 6; $i++) {
            $otp .= $this->_getSanitizedParam('otp' . $i);
        }
        $email = base64_decode($this->_getSanitizedParam('email'));
        $dateFifteenMinutesAgo = date('Y-m-d H:i:s', strtotime('-15 minutes'));
        $otpModel = new Administracion_Model_DbTable_Otpcodes();
        // $otpData = $otpModel->getList("code = '$otp' AND date >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)", "");
        $otpData = $otpModel->getList("code = '$otp' AND date >= '$dateFifteenMinutesAgo'", "");

        if (!$otpData) {
            $response = array(
                "error" => 1,
                "message" => "Código de verificación incorrecto o expirado. Por favor, inténtelo de nuevo."
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login?emp=1');
            exit;
        }


        $email = $otpData[0]->user;
        $cedula = $otpData[0]->nit;
        $userModel = new core_Model_DbTable_User();

        $resUser = $userModel->searchUserByUser($cedula);

        if (!$resUser) {
            $response = array(
                "error" => 1,
                "message" => "No se encontró un asociado con el documento ingresado"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login?emp=');
            exit;
        }

        $data = [];
        $data['kt_login_id'] = $resUser->user_id;
        $data['kt_login_level'] = $resUser->user_level;
        $data['kt_login_user'] = $resUser->user_user;
        $data['kt_login_name'] = $resUser->user_names;
        $data['kt_last_names'] = $resUser->user_lastnames;
        $data['user_phone'] = $resUser->user_phone;
        $data['user_email'] = $resUser->user_email;
        $data['user_negocio'] = $resUser->user_negocio;
        $data['emprendimiento'] = 1;
        $_SESSION["asociado"] = $data;
        Session::getInstance()->set("kt_login_id", $resUser->user_id);
        Session::getInstance()->set("kt_login_level", $resUser->user_level);
        Session::getInstance()->set("kt_login_user", $resUser->user_user);
        Session::getInstance()->set("kt_login_name", $resUser->user_names);
        Session::getInstance()->set("kt_last_names", $resUser->user_lastnames);
        Session::getInstance()->set("user_phone", $resUser->user_phone);
        Session::getInstance()->set("user_email", $resUser->user_email);
        Session::getInstance()->set("user_negocio", $resUser->user_negocio);
        Session::getInstance()->set("emprendimiento", 1);
        Session::getInstance()->set("asociado", $data);

        header('Location: /');
        exit;

    }
    private function generateOTP($length = 6)
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= random_int(0, 9);
        }
        return $otp;
    }
    public function loginOLDAction()
    {

        $this->getLayout()->setData("ocultarcarrito", 1);

        $this->setLayout("blanco");
        $user = $this->_getSanitizedParam("user");
        $password = $this->_getSanitizedParam("password");
        if (!$user || !$password) {
            $response = array(
                "error" => 1,
                "message" => "Debe ingresar su cédula y clave"
            );
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }

        $response = $this->iniciarSesion($user, $password);
        if ($response["error"] == 1) {
            Session::getInstance()->set("error_login", $response);
            header('Location: /page/login');
            exit;
        }

        $data = [];
        $data['kt_login_id'] = $response['user']['user_id'];
        $data['kt_login_level'] = $response['user']['user_level'];
        $data['kt_login_user'] = $response['user']['user_user'];
        $data['kt_login_name'] = $response['user']['user_names'];
        $data['kt_last_names'] = $response['user']['user_lastnames'];
        $data['user_phone'] = $response['user']['user_phone'];
        $data['user_email'] = $response['user']['user_email'];
        $_SESSION["asociado"] = $data;
        Session::getInstance()->set("kt_login_id", $response['user']['user_id']);
        Session::getInstance()->set("kt_login_level", $response['user']['user_level']);
        Session::getInstance()->set("kt_login_user", $response['user']['user_user']);
        Session::getInstance()->set("kt_login_name", $response['user']['user_names']);
        Session::getInstance()->set("kt_last_names", $response['user']['user_lastnames']);
        Session::getInstance()->set("user_phone", $response['user']['user_phone']);
        Session::getInstance()->set("user_email", $response['user']['user_email']);
        Session::getInstance()->set("asociado", $data);

        header('Location: /');
        exit;

    }


    public function iniciarSesion($user, $password)
    {
        $url = "https://www.fendesa.com/sistema/loginuser/loginemprendimiento";
        $hash = md5("OMEGA_" . date("Y-m-d"));

        $data = array(
            'user' => $user,
            'password' => $password,
            'hash' => $hash
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Agregar User-Agent
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
        if (is_countable($response) && count($response) > 0) {
            return $response;
        } else {
            return false;
        }
    }






    /* Adm.2025*
    https://www.fendesa.com/sistema/loginuser/loginemprendimiento
    */







    public function logoutAction()
    {
        //LOG
        $data['log_tipo'] = "LOGOUT";
        $_SESSION['video_ok'] = "";
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);

        Session::getInstance()->set("kt_login_id", "");
        Session::getInstance()->set("kt_login_level", "");
        Session::getInstance()->set("kt_login_user", "");
        Session::getInstance()->set("kt_login_name", "");
        Session::getInstance()->set("kt_cedula", "");
        Session::getInstance()->set("video", "");

        Session::getInstance()->set("kt_nombre", "");
        Session::getInstance()->set("kt_celular", "");
        Session::getInstance()->set("kt_login_nivel", "");
        Session::getInstance()->set("kt_correo", "");
        Session::getInstance()->set("kt_accion", "");
        Session::getInstance()->set("quien_accion", "");
        Session::getInstance()->set("asociado", "");
        session_destroy();

        header('Location: /page/login');
    }




    public function invitacionAction()
    {
        $this->getLayout()->setData("ocultarcarrito", 1);
        $kt_accion = $_SESSION['kt_accion'];
        $hoy = date("Y-m-") . "01";

        $usuarioModel = new Administracion_Model_DbTable_Usuario();
        $invitados = $usuarioModel->getList(" user_accion='$kt_accion' AND user_date>='$hoy' ", "");
        $this->_view->invitados = $invitados;
    }



    public function encriptar($x)
    {
        $x = base64_encode("*" . $x . "*");
        $x = str_replace("=", "_", $x);
        return $x;
    }

    public function desencriptar($x)
    {
        $x = str_replace("_", "=", $x);
        $x = base64_decode($x);
        $x = str_replace("*", "", $x);
        return $x;
    }




    public function autenticarAction()
    {
        $data = [];
        $data['kt_login_id'] = $this->_getSanitizedParam("kt_login_id");
        $data['kt_login_level'] = $this->_getSanitizedParam("kt_login_level");
        $data['kt_login_user'] = $this->_getSanitizedParam("kt_login_user");
        $data['kt_login_name'] = $this->_getSanitizedParam("kt_login_name");
        $data['kt_last_names'] = $this->_getSanitizedParam("kt_last_names");
        $data['user_phone'] = $this->_getSanitizedParam("user_phone");
        $data['user_email'] = $this->_getSanitizedParam("user_email");
        $_SESSION["asociado"] = $data;
        Session::getInstance()->set("kt_login_id", $this->_getSanitizedParam("kt_login_id"));
        Session::getInstance()->set("kt_login_level", $this->_getSanitizedParam("kt_login_level"));
        Session::getInstance()->set("kt_login_user", $this->_getSanitizedParam("kt_login_user"));
        Session::getInstance()->set("kt_login_name", $this->_getSanitizedParam("kt_login_name"));
        Session::getInstance()->set("kt_last_names", $this->_getSanitizedParam("kt_last_names"));

        Session::getInstance()->set("user_phone", $this->_getSanitizedParam("user_phone"));
        Session::getInstance()->set("user_email", $this->_getSanitizedParam("user_email"));

        Session::getInstance()->set("asociado", $data);
        $this->_view->e = $this->_getSanitizedParam("e");
        $this->_view->id = $this->_getSanitizedParam("id");
        $this->_view->n = $this->_getSanitizedParam("n");
    }
}
