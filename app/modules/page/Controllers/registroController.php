<?php

/**
 *
 */

class Page_registroController extends Page_mainController
{

	public function indexAction()
	{
		$this->getLayout()->setData("ocultarcarrito", 1);
		$categoriaModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categoriaModel->getList(" categorias_padre='0' AND categorias_estado='1'", " orden ASC ");

		$cedula = $this->desencriptar($this->_getSanitizedParam("c"));
		$nombre = $this->desencriptar($this->_getSanitizedParam("n"));
		$accion = $this->desencriptar($this->_getSanitizedParam("a"));
		$correo = $this->desencriptar($this->_getSanitizedParam("e"));

		$this->_view->cedula = $cedula;
		$this->_view->nombre = $nombre;
		$this->_view->accion = $accion;
		$this->_view->correo = $correo;


		$accion1 = $this->numeroaccion($accion);
		$socioModel = new Administracion_Model_DbTable_Socios();
		$socio = $socioModel->getList(" socio_carnet='$accion1' ", "")[0];
		$this->_view->socio = $socio;
	}


	public function desencriptar($x)
	{
		$x = str_replace("_", "=", $x);
		$x = base64_decode($x);
		$x = str_replace("*", "", $x);
		return $x;
	}

	public function insertarAction()
	{
		$usuarioModel = new Administracion_Model_DbTable_Usuario();
		$tiendaModel = new Administracion_Model_DbTable_Tiendas();
		$socioModel = new Administracion_Model_DbTable_Socios();

		if (($this->_getSanitizedParam("usuario") == 2) || ($this->_getSanitizedParam("usuario") == 3)) {
			$data = $this->getDatauser();
			$id = $usuarioModel->insert($data);
			//LOG
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = "CREAR USUARIO";
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
			header("Location: /page/login?error=false&&user=persona&&invitado=1");
		} else if (
			($this->_getSanitizedParam("usuario") == 4) ||
			($this->_getSanitizedParam("usuario") == 5)
		) {


			$datanegocio = $this->getDatanegocio();
			$uploadImage = new Core_Model_Upload_Image();

			if ($_FILES['tiendas_imagen']['name'] != '') {
				$datanegocio['tiendas_imagen'] = $uploadImage->upload("tiendas_imagen");
			}

			$idnegocio = $tiendaModel->insert($datanegocio);

			$datauser = $this->getDatausernegocio($idnegocio);


			if ($this->_getSanitizedParam("usuario") == 4) {

				$socio = $this->getAsociado($this->_getSanitizedParam("socio_cedula"));
				if ($socio->socio_cedula) {
					$datauser["user_user"] = $socio->socio_cedula;
				}
			}

			$id = $usuarioModel->insert($datauser);

			//LOG
			$datauser['log_log'] = print_r($datauser, true);
			$datauser['log_tipo'] = "CREAR USUARIO";
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($datauser);


			$infoTienda = $tiendaModel->getById($idnegocio);
			$infoUser = $usuarioModel->getById($id);
			if ($infoTienda && $infoUser) {

				$mailModel = new Core_Model_Sendingemail($this->_view);
				$res = $mailModel->enviarCorreoRegistro($infoTienda, $infoUser);

				header("Location: /page/index?emp=1&registro=1&mail=$res");
				return;

			}
			header("Location: /page/login?emp=1&registro=2&mail=2");
			return;

		}
	}
	private function getDatauser()
	{

		$data = array();
		if ($this->_getSanitizedParam("user_state") == '') {
			$data['user_state'] = '1';
		} else {
			$data['user_state'] = $this->_getSanitizedParam("user_state");
		}
		$data['user_date'] = date("Y-m-d");
		$data['user_names'] = $this->_getSanitizedParam("nombre");
		$data['user_email'] = $this->_getSanitizedParam("correo");
		if ($this->_getSanitizedParam("usuario") == '') {
			$data['user_level'] = '0';
		} else {
			$data['user_level'] = $this->_getSanitizedParam("usuario");
		}
		$data['user_user'] = $this->_getSanitizedParam("usuario_persona");
		$data['user_password'] = $this->_getSanitizedParam("contrasena_persona");
		$data['user_delete'] = '1';
		$data['user_current_user'] = '1';
		$data['user_code'] = '1';
		$data['user_negocio'] = 0;
		$data['user_accion'] = $this->numeroaccion($this->_getSanitizedParam("accion"));
		$data['user_telefono'] = $this->_getSanitizedParam("telefono");
		$data['user_invitado_socio'] = $this->_getSanitizedParam("nombre_socio");
		return $data;
	}

	private function getDatausernegocio($id)
	{

		$data = array();
		if ($this->_getSanitizedParam("user_state") == '') {
			$data['user_state'] = '0';
		} else {
			$data['user_state'] = $this->_getSanitizedParam("user_state");
		}
		$data['user_date'] = date("Y-m-d");
		$data['user_names'] = $this->_getSanitizedParam("negocio");
		$data['user_email'] = $this->_getSanitizedParam("correo_negocio");
		if ($this->_getSanitizedParam("usuario") == '') {
			$data['user_level'] = '0';
		} else {
			$data['user_level'] = $this->_getSanitizedParam("usuario");
		}
		$data['user_user'] = $this->_getSanitizedParam("documento_asociado");
		$data['user_password'] = $this->_getSanitizedParam("contrasena_negocio");
		$data['user_delete'] = '1';
		$data['user_current_user'] = '1';
		$data['user_code'] = '1';
		$data['user_negocio'] = $id;
		$data['user_accion'] = $this->numeroaccion($this->_getSanitizedParam("documento_asociado"));
		$data['user_telefono'] = $this->_getSanitizedParam("telefono_negocio");
		return $data;
	}
	private function getDatanegocio()
	{
		$data = array();
		$data['tiendas_nombre'] = $this->_getSanitizedParam("negocio");
		$data['tiendas_descripcion'] = $this->_getSanitizedParamHtml("descripcion");
		$data['tiendas_pagina'] = $this->enlacepagina($this->_getSanitizedParam("pagina_web"));
		$data['tiendas_facebook'] = $this->enlaceredes($this->_getSanitizedParam("facebook"));
		$data['tiendas_instagram'] = $this->enlaceredes($this->_getSanitizedParam("instagram"));
		$data['tiendas_telefono'] = $this->_getSanitizedParam("telefono_negocio");
		$data['tiendas_datos'] = $this->_getSanitizedParamHtml("tiendas_datos");
		$data['tiendas_whatsapp'] = $this->_getSanitizedParam("whatsapp");
		$data['tiendas_imagen'] = "";
		$data['tiendas_categoria'] = $this->_getSanitizedParamHtml("categoria");
		return $data;
	}

	public function enlaceredes($x)
	{
		$x = str_replace("@", "", $x);
		$x = str_replace("https://www.instagram.com", "", $x);
		$x = str_replace("https://es-la.facebook.com", "", $x);
		$x = str_replace("facebook.com", "", $x);
		$x = str_replace("instagram.com", "", $x);
		$x = str_replace("/", "", $x);
		$x = str_replace("https:m.", "", $x);
		$x = str_replace("https:www.", "", $x);
		$x = str_replace("www.", "", $x);
		return $x;
	}
	public function enlacepagina($x)
	{
		$x = str_replace("https://", "", $x);
		$x = str_replace("http://", "", $x);
		return $x;
	}
	public function numeroaccion($x)
	{
		$x = str_pad($x, 8, "0", STR_PAD_LEFT);
		return $x;
	}

	public function pruebaenvioAction()
	{
		$infopageModel = new Page_Model_DbTable_Informacion();
		$infopage = $infopageModel->getById(1);
		$mail_negocio = $infopage->info_pagina_correos_contacto;
		$content = '<p>Buenos días,</p>
		 ha solicitado el registro a la pagina emprendimiento fendesa';

		$emailModel = new Core_Model_Mail();
		$asunto = "Solicitud de registro emprendimiento fendesa";

		// $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
		$emailModel->getMail()->addCC("desarrollo8@omegawebsystems.com");
		// $emailModel->getMail()->addAddress($mail_negocio);

		$emailModel->getMail()->Subject = $asunto;
		$emailModel->getMail()->msgHTML($content);
		$emailModel->getMail()->AltBody = $content;
		$emailModel->getMail()->SMTPDebug = 0;
		$emailModel->sed();
	}
}
