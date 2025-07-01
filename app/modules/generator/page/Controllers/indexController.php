<?php 

/**
*
*/

class Page_indexController extends Page_mainController
{

	public function indexAction()
	{
		
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$publicidadModel = new Administracion_Model_DbTable_Publicidad();
		$popup=$publicidadModel->getList("publicidad_seccion=6","")[0];

		$catgoria = $this->_getSanitizedParam('categoria');
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$buscar = $this->_getSanitizedParam('buscar');
		if ($catgoria != "") {
			$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		}elseif ($catgoria == "") {
			$this->_view->productos = $this->template->getProductos($buscar);
		}

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias = $categorias;
		$this->_view->popup = $popup;
		$_SESSION['video_ok']=1;
	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}