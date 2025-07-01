<?php 

/**
*
*/

class Page_mainController extends Controllers_Abstract
{

	public $template;

	public function init()
	{
		$this->setLayout('page_page');
		$this->template = new Page_Model_Template_Template($this->_view);
		$infopageModel = new Page_Model_DbTable_Informacion();
		$this->_view->infopage = $infopageModel->getById(1);

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categoriasModel->getList("","orden ASC");
		$this->getLayout()->setData("metadescription",$this->_view->infopage->info_pagina_descripcion);
		$this->getLayout()->setData("metakeywords",$this->_view->infopage->info_pagina_tags);
		$this->getLayout()->setData("info_pagina_scripts",$this->_view->infopage->info_pagina_scripts);
		if($_SESSION['kt_login_id']=="" and strpos($_SERVER['REQUEST_URI'],"/login")===FALSE and strpos($_SERVER['REQUEST_URI'],"/zonaprivada")===FALSE and strpos($_SERVER['REQUEST_URI'],"/registro")===FALSE){
			header("Location:/page/login/");

		}else{
	
			$kt_nombre = $_SESSION['kt_login_name'];
			$this->_view->nombre= $kt_nombre;
			
		}
		$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
		$this->getLayout()->setData("header",$header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer",$footer);
		$this->usuario();
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->contenidohome = $contenidoModel->getList("contenido_seccion = '1' AND contenido_padre != '0' ", "orden ASC");
		$this->_view->actividadesVirtuales = $contenidoModel->getList("contenido_seccion = '14' AND contenido_padre != '0' ", "orden DESC")[0];
		$this->_view->enTarima = $contenidoModel->getList("contenido_seccion = '15' AND contenido_padre != '0' ", "orden DESC LIMIT 3");
		$this->_view->otros = $contenidoModel->getList("contenido_seccion = '16' AND contenido_padre != '0' ", "orden DESC LIMIT 2 ");
		$this->_view->actividadesVirtualesPadre = $contenidoModel->getList("contenido_seccion = '14' AND contenido_padre = '0' ", "orden DESC")[0];
		$this->_view->enTarimaPadre = $contenidoModel->getList("contenido_seccion = '15' AND contenido_padre = '0' ", "orden DESC")[0];
		$this->_view->otrosPadre = $contenidoModel->getList("contenido_seccion = '16' AND contenido_padre = '0' ", "orden DESC")[0];
	
	}


	public function usuario(){
		$userModel = new Core_Model_DbTable_User();
		$user = $userModel->getById(Session::getInstance()->get("kt_login_id"));
		if($user->user_id == 1){
			$this->editarpage = 1;
		}
	}

} 