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

		$departamentosModel = new Administracion_Model_DbTable_Departamentos(

		);
		$municipiosModel = new Administracion_Model_DbTable_Municipios();
		$departamentos = $departamentosModel->getList("", " departamento ASC");
		//formatear utf8encode
		/* 	foreach ($departamentos as $departamento) {
								 $departamento->departamento = mb_convert_encoding($departamento->departamento, 'ISO-8859-1', 'UTF-8');
							 }
						*/
		$this->_view->departamentos = $departamentos;
		$municipios = $municipiosModel->getList("", "municipio ASC");
		//formatear utf8encode
		/* foreach ($municipios as $municipio) {
								$municipio->municipio = mb_convert_encoding($municipio->municipio, 'ISO-8859-1', 'UTF-8');
							} */
		$this->_view->municipios = $municipios;

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

			// Procesar documentos si hay archivos
			$documentosSubidos = $this->procesarDocumentos();

			$datanegocio = $this->getDatanegocio();
			$uploadImage = new Core_Model_Upload_Image();

			if ($_FILES['tiendas_imagen']['name'] != '') {
				$datanegocio['tiendas_imagen'] = $uploadImage->upload("tiendas_imagen");
			}

			$idnegocio = $tiendaModel->insert($datanegocio);

			$datauser = $this->getDatausernegocio($idnegocio);

			// Agregar datos de persona al usuario
			$datauser = array_merge($datauser, $this->getDataPersona());

			// Agregar documentos individualmente al usuario
			if (!empty($documentosSubidos)) {
				foreach ($documentosSubidos as $campo => $archivo) {
					$datauser[$campo] = $archivo;
				}
			}

			if ($this->_getSanitizedParam("usuario") == 4) {
				$socioModel = new Administracion_Model_DbTable_Socios();
				$tipoPersona = $this->_getSanitizedParam("persona_tipo");

				if ($tipoPersona === 'J') {
					// Para persona jurídica, buscar por el documento del asociado jurídica
					$documento_buscar = $this->_getSanitizedParam("pj_documento_asociado");
				} else {
					// Para persona natural, usar el documento asociado normal
					$documento_buscar = $this->_getSanitizedParam("documento_asociado");
				}

				$socios = $socioModel->getList("socio_cedula = '" . $documento_buscar . "'");
				if (!empty($socios)) {
					$datauser["user_user"] = $socios[0]->socio_cedula;
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

		// Determinar qué documento usar según el tipo de persona
		$tipoPersona = $this->_getSanitizedParam("persona_tipo");
		if ($tipoPersona === 'J') {
			// Para persona jurídica, usar el documento del asociado jurídica
			$data['user_user'] = $this->_getSanitizedParam("pj_documento_asociado");
			$documento_para_accion = $this->_getSanitizedParam("pj_documento_asociado");
		} else {
			// Para persona natural, usar el documento asociado normal
			$data['user_user'] = $this->_getSanitizedParam("documento_asociado");
			$documento_para_accion = $this->_getSanitizedParam("documento_asociado");
		}

		$data['user_password'] = $this->_getSanitizedParam("contrasena_negocio");
		$data['user_delete'] = '1';
		$data['user_current_user'] = '1';
		$data['user_code'] = '1';
		$data['user_negocio'] = $id;
		$data['user_accion'] = $this->numeroaccion($documento_para_accion);
		$data['user_telefono'] = $this->_getSanitizedParam("telefono_negocio");

		// Agregar campos adicionales para persona jurídica
		if ($tipoPersona === 'J') {
			$data['pj_asociado_nombres'] = $this->_getSanitizedParam("pj_asociado_nombres");
			$data['pj_asociado_apellidos'] = $this->_getSanitizedParam("pj_asociado_apellidos");
			$data['pj_documento_asociado'] = $this->_getSanitizedParam("pj_documento_asociado");

			$data['pj_asociado_nombres'] = $this->_getSanitizedParam("pj_asociado_nombres");
			$data['pj_asociado_apellidos'] = $this->_getSanitizedParam("pj_asociado_apellidos");
			$data['pj_documento_asociado'] = $this->_getSanitizedParam("pj_documento_asociado");
		}

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
		$data['tiendas_correo'] = $this->_getSanitizedParam("correo_negocio");
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
	private function getDataPersona()
	{
		$data = array();
		$data['persona_tipo'] = $this->_getSanitizedParam("persona_tipo");
		$data['persona_fecha_registro'] = date("Y-m-d H:i:s");

		if ($this->_getSanitizedParam("persona_tipo") == 'N') {
			// Datos Persona Natural
			$data['pn_nombres'] = $this->_getSanitizedParam("pn_nombres");
			$data['pn_apellidos'] = $this->_getSanitizedParam("pn_apellidos");
			$data['user_lastnames'] = $this->_getSanitizedParam("pn_apellidos");
			$data['pn_id_tipo'] = $this->_getSanitizedParam("pn_id_tipo");
			$data['pn_documento'] = $this->_getSanitizedParam("documento_asociado");
			$data['pn_fecha_nacimiento'] = $this->_getSanitizedParam("pn_fecha_nacimiento");
			$data['pn_telefono_contacto'] = $this->_getSanitizedParam("pn_telefono_contacto");
			$data['pn_email'] = $this->_getSanitizedParam("pn_email");
			$data['pn_nivel_estudio'] = $this->_getSanitizedParam("pn_nivel_estudio");
			$data['pn_actividad'] = $this->_getSanitizedParam("pn_actividad");
			$data['pn_departamento'] = $this->_getSanitizedParam("pn_departamento");
			$data['pn_municipio'] = $this->_getSanitizedParam("pn_municipio");
			$data['pn_direccion'] = $this->_getSanitizedParam("pn_direccion");
		} else if ($this->_getSanitizedParam("persona_tipo") == 'J') {
			// Datos Persona Jurídica
			$data['pj_razon_social'] = $this->_getSanitizedParam("pj_razon_social");
			$data['pj_nit'] = $this->_getSanitizedParam("pj_nit");
			$data['pj_email_notificaciones'] = $this->_getSanitizedParam("pj_email_notificaciones");
			$data['pj_telefono'] = $this->_getSanitizedParam("pj_telefono");
			$data['pj_direccion'] = $this->_getSanitizedParam("pj_direccion");
			$data['pj_departamento'] = $this->_getSanitizedParam("pj_departamento");
			$data['pj_municipio'] = $this->_getSanitizedParam("pj_departamento");
			$data['pj_ciiu'] = $this->_getSanitizedParam("pj_ciiu");
			$data['pj_tipo_empresa'] = $this->_getSanitizedParam("pj_tipo_empresa");
			$data['pj_empleados_cargo'] = $this->_getSanitizedParam("pj_empleados_cargo");

			// Representante Legal
			$data['pj_rep_apellido1'] = $this->_getSanitizedParam("pj_rep_apellido1");
			$data['pj_rep_apellido2'] = $this->_getSanitizedParam("pj_rep_apellido2");
			$data['pj_rep_nombres'] = $this->_getSanitizedParam("pj_rep_nombres");
			$data['pj_rep_id_tipo'] = $this->_getSanitizedParam("pj_rep_id_tipo");
			$data['pj_rep_id_numero'] = $this->_getSanitizedParam("pj_rep_id_numero");
			$data['pj_rep_expedicion_lugar'] = $this->_getSanitizedParam("pj_rep_expedicion_lugar");
			$data['pj_rep_expedicion_fecha'] = $this->_getSanitizedParam("pj_rep_expedicion_fecha");
			$data['pj_rep_nacionalidad'] = $this->_getSanitizedParam("pj_rep_nacionalidad");
			$data['pj_rep_fecha_nacimiento'] = $this->_getSanitizedParam("pj_rep_fecha_nacimiento");
			$data['pj_rep_lugar_nacimiento'] = $this->_getSanitizedParam("pj_rep_lugar_nacimiento");
		}

		return $data;
	}
	private function procesarDocumentos()
	{
		$uploadDocument = new Core_Model_Upload_Document();
		$documentosSubidos = array();

		$tipoPersona = $this->_getSanitizedParam("persona_tipo");

		if ($tipoPersona == 'N') {
			// Documentos Persona Natural
			$documentosNaturales = [
				'user_cc',
				'user_certificacion',
				'user_declaracion'
			];

			foreach ($documentosNaturales as $campo) {
				if (isset($_FILES[$campo]) && $_FILES[$campo]['name'] != '') {
					$nombreArchivo = $uploadDocument->upload($campo);
					if ($nombreArchivo) {
						$documentosSubidos[$campo] = $nombreArchivo;
					}
				}
			}
		} else if ($tipoPersona == 'J') {
			// Documentos Persona Jurídica
			$documentosJuridicos = [
				'user_certificado_representacion',
				'user_rut',
				'user_documento_identidad',
				'user_certificado_bancario'
			];

			foreach ($documentosJuridicos as $campo) {
				if (isset($_FILES[$campo]) && $_FILES[$campo]['name'] != '') {
					$nombreArchivo = $uploadDocument->upload($campo);
					if ($nombreArchivo) {
						$documentosSubidos[$campo] = $nombreArchivo;
					}
				}
			}
		}

		return $documentosSubidos;
	}
}
