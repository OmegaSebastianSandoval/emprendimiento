<?php

/**
 *
 */

class Page_mainController extends Controllers_Abstract
{

	public $template;
	public $botonpanel = 0;

	public function init()
	{
		$this->_view->botonpanel = $this->botonpanel;

		$this->setLayout('page_page');
		$this->template = new Page_Model_Template_Template($this->_view);
		$infopageModel = new Page_Model_DbTable_Informacion();
		$this->_view->infopage = $infopageModel->getById(1);

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categoriasModel->getList("categorias_estado='1'", "orden ASC");
		$this->getLayout()->setData("metadescription", $this->_view->infopage->info_pagina_descripcion);
		$this->getLayout()->setData("metakeywords", $this->_view->infopage->info_pagina_tags);
		$this->getLayout()->setData("info_pagina_scripts", $this->_view->infopage->info_pagina_scripts);
		if ($_SESSION['kt_login_name'] == "" and strpos($_SERVER['REQUEST_URI'], "/login") === FALSE and strpos($_SERVER['REQUEST_URI'], "/zonaprivada") === FALSE and strpos($_SERVER['REQUEST_URI'], "/registro") === FALSE and strpos($_SERVER['REQUEST_URI'], "/enviarbackup") === FALSE) {
			// header("Location:/page/login/");
		} else {

			$kt_nombre = Session::getInstance()->get("kt_login_name");
			$this->_view->nombre = $kt_nombre;
		}
		$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
		$this->getLayout()->setData("header", $header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer", $footer);
		$this->usuario();
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->contenidohome = $contenidoModel->getList("contenido_seccion = '1' AND contenido_padre != '0' AND contenido_estado='1'", "orden ASC");
		$this->_view->actividadesVirtuales = $contenidoModel->getList("contenido_seccion = '14' AND contenido_padre != '0' AND contenido_estado='1'", "orden DESC")[0];
		$this->_view->enTarima = $contenidoModel->getList("contenido_seccion = '15' AND contenido_padre != '0' AND contenido_estado='1'", "orden DESC LIMIT 3");
		$this->_view->otros = $contenidoModel->getList("contenido_seccion = '16' AND contenido_padre != '0' AND contenido_estado='1'", "orden DESC");
		$this->_view->actividadesVirtualesPadre = $contenidoModel->getList("contenido_seccion = '14' AND contenido_padre = '0' AND contenido_estado='1'", "orden DESC")[0];
		$this->_view->enTarimaPadre = $contenidoModel->getList("contenido_seccion = '15' AND contenido_padre = '0' AND contenido_estado='1'", "orden DESC")[0];
		$this->_view->otrosPadre = $contenidoModel->getList("contenido_seccion = '16' AND contenido_padre = '0' AND contenido_estado='1'", "orden DESC")[0];
	}


	public function usuario()
	{
		$userModel = new Core_Model_DbTable_User();
		$user = $userModel->getById(Session::getInstance()->get("kt_login_id"));
		if ($user->user_id == 1) {
			$this->editarpage = 1;
		}
	}

	public function getAsociado($cedula = '')
	{
		$url = "https://creditos.fendesa.com/page/sistema/getasociadofendesa";
		$hash = md5("OMEGA_" . date("Y-m-d"));
		if (!$cedula) {
			$cedula = "19269578";
		}
		$url .= "?cedula=" . $cedula . "&hash=" . $hash;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Agregar User-Agent
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);
		if (is_countable($response) && count($response) > 0) {
			return $response;
		} else {
			return false;
		}
	}
		public function getAsociadoInfo($cedula = '')
	{
		$url = "https://creditos.fendesa.com/page/sistema/getasociadofendesa";
		$hash = md5("OMEGA_" . date("Y-m-d"));
		if (!$cedula) {
			$cedula = "19269578";
		}
		$url .= "?cedula=" . $cedula . "&hash=" . $hash;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Agregar User-Agent
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);
		if (is_countable($response) && count($response) > 0) {			
			$data['user_names'] = $response['user_names'];
			$data['user_lastnames'] = $response['user_lastnames'];
			$data['user_email'] = $response['user_email'];
			return $data;
		} else {
			return false;
		}
	}
}
