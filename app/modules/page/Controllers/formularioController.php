<?php 
//**************************************** INSTANCIA LA TABLA DE INFORMACION CON EL INDEX DE FORMULARIO ************************************
 

class Page_formularioController extends Page_mainController
{

	public function indexAction()
	{
        //$this->_view->bannersimple = $this->template->bannersimple(3);
        $this->_view->bannersimple = $this->template->bannerprincipal(1);
        $contactosModel = new Page_Model_DbTable_Informacion();
        $this->_view->informaciones = $contactosModel->getList("'1'","");
        //USAMOS VARIABLE QUE NO SEA LISTA (SIN FOREACH)
        $this->_view->red = $contactosModel->getById('1');
        //
        $this->_view->res = $this->_getSanitizedParam('res');


        $portafoliosModel = new Page_Model_DbTable_Contenido();
        $this->_view->terminos= $portafoliosModel->getList(" contenido_seccion='11' ","")[0];

    }
//****************************************/ESTE ARCHIVO RECIBE LOS DATOS DEL FORMULARIO Y LOS ENVIA AL CORREO QUE SE DIGITA************************************

    public function enviarAction(){
        //error_reporting(E_ALL);
        $this->setLayout('blanco');
        $data = [''];
        $data ['formulario_nombre'] = $this->_getSanitizedParam('formulario_nombre');
        $data ['formulario_email'] = $this->_getSanitizedParam('formulario_email');
        $data ['formulario_telefono'] = $this->_getSanitizedParam('formulario_telefono');
        $data ['formulario_ciudad'] = $this->_getSanitizedParam('formulario_ciudad');
        $data ['formulario_mensaje'] = $this->_getSanitizedParam('formulario_mensaje');

        //Llamar la instancia del modelo
        //$formularioModel = new Page_Model_DbTable_Formulario();
        //$formulario = $formularioModel->insert($data);
        $envioCorreo = $this->enviarCorreo($data);

        header("Location: /page/formulario?res=".$res);

    }

    public function enviarCorreo($data){

        $content = "<h1>Contacto Nogal Delivery</h1><b>Nombre: </b>".$data['formulario_nombre']."<br><b>Correo: </b>".$data['formulario_email']."<br><b>Teléfono: </b>".$data['formulario_telefono']."<br><b>Ciudad: </b>".$data['formulario_ciudad']."<br><b>Mensaje: </b>".$data['formulario_mensaje'];

        $emailModel = new Core_Model_Mail();
        $asunto = "Contacto Nogal Delivery";

        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $emailModel->getMail()->addCC("".$data['formulario_email']);
        $emailModel->getMail()->addAddress("nogaldelivery@clubelnogal.com");

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->getMail()->SMTPDebug = 0;
        $emailModel->sed();

    }

}